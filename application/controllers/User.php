<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user extends CI_Controller {

	private static $data = array();

	function __construct() {
		parent::__construct();
		$this->load->helper(array('helperssl'));
		$this->load->model('chat/ChatOperationsHandler', 'chat');
		$this->load->model('DatabaseOperationsHandler', 'database');
		$this->load->model('CommonOperationsHandler', 'common');
		$this->load->model('EmailOperationsHandler', 'email_op');
		$this->common->is_logged();

		/*Load Defaults*/
		self::$data['settings'] 						= 	$this->database->getSettingsData();
		self::$data['platforms']                        =   $this->database->_get_row_data('tbl_platforms',array('type'=>'listing','status'=>1));
		self::$data['options']                        	=   $this->database->_get_row_data('tbl_platforms',array('type'=>'option','status'=>1));
		self::$data['languages']						=	$this->database->load_all_languages();
		self::$data['default_currency']					=	$this->common->getCurrency('USD','symbol');
		self::$data['userdata'] 						= 	$this->database->getUserData($this->session->userdata('user_id'));
		self::$data['selectedLanguage'] 				= 	$this->common->is_language();
		self::$data['openContracts']					= 	$this->database->_get_my_contracts();
		self::$data['closeContracts']					= 	$this->database->_get_my_contracts(false);
		self::$data['listingCount']						= 	$this->database->_count_listings_user_wise('auction');
		self::$data['listingOfferCount']				= 	$this->database->_count_listings_user_wise('classified');
		self::$data['messageCount']						= 	$this->chat->get_unviewed_msg($this->session->userdata('user_id'));
		self::$data['categoriesData']					=	$this->database->_count_listings_categories_wise();
		self::$data['announcements']                    =   $this->database->_get_row_data('tbl_announcement',array('status'=>1));
		self::$data['pages']                    		=   $this->database->_get_row_data('tbl_pages',array('page_visibility_status'=>1));
		self::$data['imagesData']						=	$this->database->_get_row_data('tbl_siteimages',array('id'=>1));
		self::$data['payments']                     	=   $this->database->_get_row_data('tbl_payment_settings',array('status'=>1));
		self::$data['ads']                				=   $this->database->_get_row_data('tbl_ads',array('id'=>1));
		self::$data['token'] 							= 	$this->security->get_csrf_hash();

		if(self::$data['settings'][0]['ssl_enable'] === '1'){
			force_ssl();
		}
		
    }

    /*User Dashboard*/
    public function dashboard(){
		$data 				= self::$data;
		$data['contracts'] 	= $this->database->_get_recent_contract(true,false,false);
		$data['TE'] 		= $this->database->_user_total_earnings($this->session->userdata('user_id'));
		$data['TL']			= $this->database->_results_count('tbl_listings',array('status'=>1,'user_id'=>$this->session->userdata('user_id')),true);
		$data = html_escape($this->security->xss_clean($data));
		$this->load->view('user/dashboard',$data);
		return;
	}

	/*Alexa Rank*/
	public function alexaRank($url){
		return $this->common->alexaRank($url);
	}

	/*Manage Bidders Page*/
	public function manage_bidders($type,$id){
		$data = self::$data;
		if(!empty($id)){
			$data['listing_data']						=	$this->database->_get_row_data('tbl_listings',array('id'=>$id,'listing_type'=>$type,'user_id'=>$this->session->userdata('user_id')),'',true);
			if(!empty($data['listing_data'][0]['domain_id'])) {
				$data['domainData']						=	$this->database->_get_row_data('tbl_domains',array('id'=>$data['listing_data'][0]['domain_id']));
				$data['listingType']					= 	$type;
				$data['bids']							= 	$this->database->_get_bidders($id);
				$data = html_escape($this->security->xss_clean($data));
				$this->load->view('user/manage-bidders',$data);
				return;
			}
		}

		$this->pageNotFound();
	}

	/*Manage Bids Page*/
	public function manage_bids($type,$id){
		$data = self::$data;
		if(!empty($id)){
			$this->_update_winning_auction($id,$type);
			$data['AuctionEndingDate']					=	$this->database->_get_auction_ending_date($id);
			$data['websitelistings'] 					= 	$this->_userwise__listings($this->session->userdata('user_id'),'auction',true,false,$id);
			$data['nofdaysleft']						=	$this->common->DateDiffCalculate($data['AuctionEndingDate'][0]['ENDDATE']);
			$data['auctionstatus']						= 	'invalid';
			if ($data['nofdaysleft']['days'] >= 0 && $data['nofdaysleft']['hours'] >= 0 ) {
				$data['auctionstatus']					= 	'valid';
			}

			$data['listing_data']						=	$this->database->_get_row_data('tbl_listings',array('id'=>$id,'listing_type'=>$type,'user_id'=>$this->session->userdata('user_id')),'',true);
			if(!empty($data['listing_data'][0]['domain_id'])) {
				$data['domainData']						=	$this->database->_get_row_data('tbl_domains',array('id'=>$data['listing_data'][0]['domain_id']));
				$data['listingType']					= 	$type;
				$data['bids']							= 	$this->database->_get_all_bids($id,'1',$type,"tbl_bids.bid_amount","desc","1");
				$data = html_escape($this->security->xss_clean($data));
				$this->load->view('user/manage-bids',$data);
				return;
			}
		}
		$this->pageNotFound();
	}

	/*Manage Offers Page*/
	public function manage_offer($type,$id){
		$data = self::$data;
		if(!empty($id)){
			$this->_update_winning_auction($id,$type);
			$data['websitelistings'] 					= 	$this->_userwise__listings($this->session->userdata('user_id'),'classified',true,false,$id);
			$data['listing_data']						= 	$this->database->_get_row_data('tbl_listings',array('id'=>$id,'listing_type'=>$type,'user_id'=>$this->session->userdata('user_id')),true);
			if(!empty($data['listing_data'][0]['domain_id'])) {
				$data['domainData']						=	$this->database->_get_row_data('tbl_domains',array('id'=>$data['listing_data'][0]['domain_id']));
				$data['listingType']					= 	$type;
				$data['bids']							= 	$this->database->_get_all_offers($id,'0',$type,"tbl_offers.offer_amount","desc","1");
				$data = html_escape($this->security->xss_clean($data));
				$this->load->view('user/manage-offers',$data);
				return;
			}
		}
		$this->pageNotFound();
	}

	/*Manage Listings Page*/
	public function manage_listings(){
		$data = self::$data;
		$data['websitelistings'] 				= 	$this->_userwise__listings($this->session->userdata('user_id'),'auction','');
		$data = html_escape($this->security->xss_clean($data));
		$this->load->view('user/manage-listings',$data);
	}

	/*Manage Listings Page*/
	public function manage_offers(){
		$data = self::$data;
		$data['websitelistings'] 				= 	$this->_userwise__listings($this->session->userdata('user_id'),'classified','');
		$data = html_escape($this->security->xss_clean($data));
		$this->load->view('user/manage-classified-listings',$data);
	}

	/*Upload Images */
    public function upload__image($nameBox,$path=IMAGES_UPLOAD){
        $this->load->library("upload");
        $this->load->helper("file");
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'jpg|png|jpeg|gif';
        $config['max_size'] = 1048576;
        $this->upload->initialize($config);
        $this->upload->overwrite = false;
        if (!$this->upload->do_upload($nameBox)) {
            $error = array('error' => $this->upload->display_errors('', ''));
            if(isset($error['error'])){
                return 'N/A';
            }
        }
        else
        {
            $image_data = $this->upload->data();
            $upload_image_name = $image_data['file_name'];
            $full_path = $image_data['full_path'];
            if(isset($full_path)){
                return $upload_image_name;
            }
        } 
    }

    /*Upload Files */
    public function upload__files($nameBox){
        $this->load->library("upload");
        $this->load->helper("file");
        $config['upload_path'] = FILES_UPLOAD;
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 1048576;
        $this->upload->initialize($config);
        $this->upload->overwrite = false;
        if (!$this->upload->do_upload($nameBox)) {
            $error = array('error' => $this->upload->display_errors('', ''));
            if(isset($error['error'])){
                return 'N/A';
            }
        }
        else
        {
            $image_data = $this->upload->data();
            $upload_image_name = $image_data['file_name'];
            $full_path = $image_data['full_path'];
            if(isset($full_path)){
                return $upload_image_name;
            }
        } 
    }

	/*Create Website Listings Page*/
	public function create_listings(){
		$data = self::$data;
		$data = html_escape($this->security->xss_clean($data));
		$this->load->view('user/create-listings',$data);
		return;
	}

	/*Create Website Listings Page*/
	public function create__listings($type,$id=""){
		if(!empty($type) && $type ==='website'){
			$data = self::$data;
			$data['listingOptions']						=	$this->database->_get_row_data('tbl_listing_header',array('listing_type'=>$type));
			$data['sponsorOptions']						=	$this->database->_get_row_data('tbl_listing_header',array('listing_type'=>'sponsored'));
			if(!empty($id)){
				$data['listing_data']					=	$this->database->_get_row_data('tbl_listings',array('id'=>$id,'listing_type'=>$type,'status'=>0,'user_id'=>$this->session->userdata('user_id')),'',false);
				if(!empty($data['listing_data'])){
					$data['domainData']					=	$this->database->_get_row_data('tbl_domains',array('id'=>$data['listing_data'][0]['domain_id']));
				}
				else
				{
					redirect(base_url().'user/manage_listings');
					return;
				}

				$data['domainStatics']					=	$this->AnalyticsOperationsHandler->getUsersAndPageViews($id);
			}
			
			$data = html_escape($this->security->xss_clean($data));
			$this->load->view('user/create-website-listings',$data);
			return;
		}
		else if(!empty($type) && $type ==='domain'){
			$data = self::$data;
			$data['listingOptions']						=	$this->database->_get_row_data('tbl_listing_header',array('listing_type'=>$type));
			$data['sponsorOptions']						=	$this->database->_get_row_data('tbl_listing_header',array('listing_type'=>'sponsored'));
			if(!empty($id)){
				$data['listing_data']					=	$this->database->_get_row_data('tbl_listings',array('id'=>$id,'listing_type'=>$type,'status'=>0,'user_id'=>$this->session->userdata('user_id')),'',false);
				if(!empty($data['listing_data'])){
					$data['domainData']					=	$this->database->_get_row_data('tbl_domains',array('id'=>$data['listing_data'][0]['domain_id']));
				}
				else
				{
					redirect(base_url().'user/manage_listings');
					return;
				}
			}

			$data = html_escape($this->security->xss_clean($data));
			$this->load->view('user/create-domain-listings',$data);
			return;
		}
		$this->pageNotFound();
	}

	/*User Profile Settings*/
	public function user_settings(){
		$data = self::$data;
		$data['metaData']						=	$this->database->getSettingsData();
		$data['withdraw_meths'] 				=  	$this->database->_get_row_data('tbl_withdrawal_methods',array('status'=>1));
		$data['reviewRatings'] 					= 	$this->database->get_reviews($this->session->userdata('user_id'),$this->session->userdata('user_id'));
		$data['profileid'] 						= 	$this->session->userdata('user_id');
		$data = html_escape($this->security->xss_clean($data));
		$this->load->view('user/user-settings',$data);
	}

	/*Change Password*/
	public function change_password(){
		$data = self::$data;
		$data['metaData']						=	$this->database->getSettingsData();
		$data['profileid'] 						= 	$this->session->userdata('user_id');
		$data = html_escape($this->security->xss_clean($data));
		$this->load->view('user/change-password',$data);
	}

	/*Edit Listings Page*/
	public function edit_listings($type,$id){
		if(!empty($type) && !empty($id) && $type =='website'){
			$data = self::$data;
			$data['listing_data']					=	$this->database->_get_row_data('tbl_listings',array('id'=>$id,'status'=>1,'user_id'=>$this->session->userdata('user_id')),'',true);
			if(!empty($data['listing_data'][0]['domain_id'])) {
				$data['domainData']					=	$this->database->_get_row_data('tbl_domains',array('id'=>$data['listing_data'][0]['domain_id']));
				$data['domainStatics']				=	$this->AnalyticsOperationsHandler->getUsersAndPageViews($id);
				$data['selectedLanguage'] 			= 	$this->common->is_language();

				if(!DECODE_DESCRIPTIONS){$data = html_escape($this->security->xss_clean($data));}
        		else{$data = $this->security->xss_clean($data);}
				
				$this->load->view('user/edit-listings',$data);
				return;
			}
		}
		else if (!empty($type) && !empty($id) && $type =='domain'){
			$data = self::$data;
			$data['listing_data']					=	$this->database->_get_row_data('tbl_listings',array('id'=>$id,'status'=>1,'user_id'=>$this->session->userdata('user_id')),'',true);
			if(!empty($data['listing_data'][0]['domain_id'])) {
				$data['domainData']					=	$this->database->_get_row_data('tbl_domains',array('id'=>$data['listing_data'][0]['domain_id']));
				$data['selectedLanguage'] 			= 	$this->common->is_language();
				
				if(!DECODE_DESCRIPTIONS){$data = html_escape($this->security->xss_clean($data));}
        		else{$data = $this->security->xss_clean($data);}

				$this->load->view('user/edit-domain-listings',$data);
				return;
			}
		}
		$this->pageNotFound();
	}

	/*Userwise Pending Offers*/
	public function pending_offers(){
		$data = self::$data;
		$data['groupedOffers'] 					=  	$this->database->_userwise_offers($this->session->userdata('user_id'),'group');
		$data = html_escape($this->security->xss_clean($data));
		$this->load->view('user/pending-offers',$data);
		return;
	}

	/*Userwise View Offers*/
	public function view_offers($id){
		$data = self::$data;
		if(!empty($id)){
			$data['Offers'] 					=  	$this->database->_get_userwise_offers($id,$this->session->userdata('user_id'),'group');
			if(!empty($data['Offers'])){
				$data = html_escape($this->security->xss_clean($data));
				$this->load->view('user/view-offers',$data);
				return;
			}
		}
		$this->pageNotFound();
	}

	/*Userwise Pending Bids*/
	public function pending_bids(){
		$data = self::$data;
		$data['groupedOffers'] 					=  	$this->database->_userwise_bids($this->session->userdata('user_id'),'group');
		$data = html_escape($this->security->xss_clean($data));
		$this->load->view('user/pending-bids',$data);
		return;
	}

	/*Userwise View Bids*/
	public function view_bids($id){
		$data = self::$data;
		if(!empty($id)){
			$data['bids'] 						=  	$this->database->_get_userwise_bids($id,$this->session->userdata('user_id'),'group');
			if(!empty($data['bids'])){
				$data = html_escape($this->security->xss_clean($data));
				$this->load->view('user/view-bids',$data);
				return;
			}
		}
		$this->pageNotFound();
	}

	/*withdrawals list pagination creator*/
	public function withdrawals_pagination_loader(){

		$config = array();
		$config["base_url"] 					= '#';
		$config["total_rows"] 					= $this->database->_results_count('tbl_withdrawals',array('user_id'=>$this->session->userdata('user_id')),true);
        $config["per_page"] 					= 5;
        $config['use_page_numbers'] 			= TRUE;

		$config['num_tag_open'] 				= '<li class="ripple-effect">';
    	$config['num_tag_close'] 				= '</li>';
    	$config['cur_tag_open'] 				= '<li><a class="ripple-effect current-page">';
    	$config['cur_tag_close']				= '</a></li>';
    	$config['prev_tag_open'] 				= '<li class="pagination-arrow">';
    	$config['prev_tag_close'] 				= '</li>';
    	$config['first_tag_open'] 				= '<li class="ripple-effect">';
    	$config['first_tag_close']				= '</li>';
    	$config['last_tag_open'] 				= '<li class="ripple-effect">';
    	$config['last_tag_close'] 				= '</li>';

    	$config['prev_link'] 					= '<i class=" mdi mdi-chevron-left"></i>';
    	$config['prev_tag_open'] 				= '<li class="pagination-arrow">';
    	$config['prev_tag_close'] 				= '</li>';


    	$config['next_link']		 			= '<i class=" mdi mdi-chevron-right"></i>';
    	$config['next_tag_open'] 				= '<li class="pagination-arrow">';
    	$config['next_tag_close'] 				= '</li>';

    	$this->pagination->initialize($config);
    	return $this->pagination->create_links();
	}

	/*Withdrawals*/
	public function withdrawals(){
		$data = self::$data;
		$data['withdraw_meths'] 				=  	$this->database->_get_row_data('tbl_withdrawal_methods',array('status'=>1));
		$data['TE'] 							= 	$this->database->_user_total_earnings($this->session->userdata('user_id'));
		$data['FC'] 							= 	$this->database->_user_withdrawals($this->session->userdata('user_id'));
		$data['PE'] 							= 	$this->database->_user_pending_earnings($this->session->userdata('user_id'));
		$data['AW'] 							= 	$this->database->_user_availableto_withdraw($this->session->userdata('user_id'));
		$data['withdrawals'] 					=	$this->database->_get_withdrawals($this->session->userdata('user_id'));
     	$data = html_escape($this->security->xss_clean($data));
     	$data["links"]							= 	$this->withdrawals_pagination_loader();
		$this->load->view('user/withdrawals',$data);
		return;
	}

	/*user withdrawals list*/
	public function user_withdrawals($page=0){
		$output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

		$data['withdrawals'] 					=	$this->database->_get_withdrawals($this->session->userdata('user_id'),'',5,$page);
		$data = html_escape($this->security->xss_clean($data));
		$data["links"]							= 	$this->withdrawals_pagination_loader();
		$response 								= 	$this->load->view('user/includes/user_withdrawals', $data, TRUE);
		$output['response']         			= 	$response;
        exit(json_encode($output));
	}

	/*Update offer status*/
	public function update_offer_status($value){
		$output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        if(!empty($value)){
        	$output['response'] 	= $this->database->_update_to_DB('tbl_offers',array('offer_status'=>'3'),$value);
			exit(json_encode($output));
        }

        $output['response'] 		= false;
		exit(json_encode($output));
	}

	/*Get Comments*/
	public function get_comments(){
		$response['token']  	= $this->security->get_csrf_hash();
		$response['response']  	= $this->database->_get_comments($this->input->post('listing_id'),$this->input->post('type'));
		$response = html_escape($this->security->xss_clean($response));
		header('Content-Type: application/json');
		exit(json_encode( $response )) ;
	}

	/*Change User Password*/
	public function changePasswordUpdate(){
		$data = array(
        'password' => md5(trim($this->input->post('txt_user_password')))
        );
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean');
        if ($this->form_validation->run()){
			exit($this->database->_update_to_table('tbl_users',$data, array('user_id'=>$this->input->post('txt_user_id'))));
		}
		exit('false');
	}

	/*accept Bidder*/
    public function accept_bidder(){
    	$output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        
    	$datas = self::$data;
        $data= array(
            'bid_status' =>1,
        );

        if($datas['settings'][0]['email_notifications'] === '1'){
        	$dataemail	= array(
            	'bid_status' =>1,
            	'id' =>$this->input->post('o_bid_id')
        	);
        	$this->email_op->_user_email_notification('accept-bidder',$dataemail);
        }   

        $output['response'] 	= $this->database->_update_to_DB('tbl_bids',$data,$this->input->post('o_bid_id'));
		exit(json_encode($output));
    }

    /*remove listing */
    public function remove_listing($id){
        $data= array(
            'status' =>6,
        );
        if($this->database->_update_to_DB('tbl_listings',$data,$id)){
        	redirect($this->session->userdata('url'));
        }
    }

    /*reject bid */
    public function reject_bid($id){
    	$datas = self::$data;
        $data= array(
            'bid_status' =>2,
        );

        if($datas['settings'][0]['email_notifications'] === '1'){
        	$dataemail	= array(
            	'bid_status' =>2,
            	'id' =>$id
        	);
        	$this->email_op->_user_email_notification('reject-bid',$dataemail);
        }  

        if($this->database->_update_to_DB('tbl_bids',$data,$id)){
        	redirect($this->session->userdata('url'));
        }
    }

    /*remove bid */
    public function remove_offer($id){
    	$datas = self::$data;
        $data= array(
            'offer_status' =>1,
        );

        if($datas['settings'][0]['email_notifications'] === '1'){
        	$dataemail	= array(
            	'offer_status' =>1,
            	'id' =>$id
        	);
        	$this->email_op->_user_email_notification('reject-offer',$dataemail);
        }

        if($this->database->_update_to_DB('tbl_offers',$data,$id)){
        	redirect($this->session->userdata('url'));
        }
    }

    /*add notification*/
    public function add_notification(){
    	$user 			= $this->session->userdata('user_id');
		$subject 		= $this->input->post('subject');
		$notification 	= $this->input->post('notification');
		$url 			= $this->input->post('url');

    	$noti_id = $this->notify->insert(array(
				'subject' 			=> $subject,
				'notification' 		=> $notification,
				'url' 				=> $url,
				'user_id ' 			=> $user,
				'view_status ' 		=> 0
		));
    }

    /*Open Contract*/
    public function open_contract(){
    	$datas = self::$data;
        if(empty($this->input->post('offer_id'))){
        $bid            =  $this->database->_get_row_data('tbl_bids',array('id'=>$this->input->post('o_bid_id_cont'),'bid_status'=>1));
        if(isset($bid[0]['id'])){
            $listing    =  $this->database->_get_row_data('tbl_listings',array('id'=>$bid[0]['listing_id']));
            $data = array(
                'contract_id' =>$this->database->_unique_id('tbl_opens','alnum','contract_id'),
                'listing_id' => $bid[0]['listing_id'],
                'bid_id' => $bid[0]['id'],
                'type' => 'bid',
                'customer_id' => $bid[0]['bidder_id'],
                'owner_id' => $bid[0]['owner_id'],
                'delivery_time' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . " + ".$listing[0]['deliver_in']." day")),
                'delivery' =>$listing[0]['deliver_in'],
                'status' => 0,
                'date' => date('Y-m-d H:i:s')

            );

            $insert_id = $this->database->_insert_to_DB('tbl_opens',$data);
            if(!empty($insert_id)){
                $this->database->_update_to_DB('tbl_bids',array('bid_status'=>'6'),$this->input->post('o_bid_id'));
                if(!empty($insert_id)){
                	if($datas['settings'][0]['email_notifications'] === '1'){
        				$this->email_op->_user_email_notification('won-bid',$data);
        			}  
    				redirect('user/contract/'.$insert_id);
    				return;
    			}
            }
        }
            return;
        }
        else
        {
            $offer            =  $this->database->_get_offer($this->input->post('offer_id'));
            if(isset($offer[0]['id'])){
            $listing    =   $this->database->_get_row_data('tbl_listings',array('id'=>$offer[0]['listing_id']));
            $data = array(
                'contract_id' =>$this->database->_unique_id('tbl_opens','alnum','contract_id'),
                'listing_id' => $offer[0]['listing_id'],
                'bid_id' => $offer[0]['id'],
                'type' => 'offer',
                'customer_id' => $offer[0]['bidder_id'],
                'owner_id' => $offer[0]['owner_id'],
                'delivery_time' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . " + ".$listing[0]['deliver_in']." day")),
                'delivery' =>$listing[0]['deliver_in'],
                'status' => 0,
                'date' => date('Y-m-d H:i:s')

            );
            	$insert_id = $this->database->_insert_to_DB('tbl_opens',$data);
                if(!empty($insert_id)){
                    $this->database->_update_to_DB('tbl_offers',array('offer_status'=>'6'),$this->input->post('offer_id'));
                    if(!empty($insert_id)){
                    	if($datas['settings'][0]['email_notifications'] === '1'){
        					$this->email_op->_user_email_notification('accept-offer',$data);
        				}  
    					redirect('user/contract/'.$insert_id);
    					return;
    				}
                }
            }
            return;
        }
    }

    /*contract view page*/
    public function contract($id){
    	$data = self::$data;
    	if(!empty($id)){
    		$data['contract']		=	$this->database->_get_contract($id);
    		if(isset($data['contract'][0]['bid_id'])){
    			$data['userprofile'] 		= 	$this->database->getUserData($data['contract'][0]['owner_id']);
    			$data['reviewRatings'] 		= 	$this->database->get_reviews($data['contract'][0]['owner_id'],$this->session->userdata('user_id'));
    			$data['contractsHistory'] 	= 	$this->database->_load_history($data['contract'][0]['id']);
 			
    			if($data['contract'][0]['type'] === 'bid'){
    				$data['biddata']		= 	$this->database->_get_bid($data['contract'][0]['bid_id']);
    			}

    			if($data['contract'][0]['type'] === 'offer'){
    				$data['biddata']		= 	$this->database->_get_offer($data['contract'][0]['bid_id']);
    			}

    			$data['contractamount']		= 	$this->database->_get_single_data('tbl_contracts',array('contract_id'=>$data['contract'][0]['id']),'amount');
    			$data['listing_data']		=	$this->database->_get_row_data('tbl_listings',array('id'=>$data['contract'][0]['listing_id']));
    		}
    		$data = $this->security->xss_clean($data);	
    		$this->load->view('user/open-contract',$data);
    		return;
    	}
    	$this->pageNotFound();
    }

    /*Closed Contract view page*/
    public function closed_contracts($id){
    	$data = self::$data;
    	if(!empty($id)){
    		$data['contract']		=	$this->database->_get_contract($id);
    		if(isset($data['contract'][0]['bid_id'])){
    			$data['userprofile'] 		= 	$this->database->getUserData($data['contract'][0]['owner_id']);
    			$data['reviewRatings'] 		= 	$this->database->get_reviews($data['contract'][0]['owner_id'],$this->session->userdata('user_id'));
    			$data['contractsHistory'] 	= 	$this->database->_load_history($data['contract'][0]['id']);
    			if($data['contract'][0]['bid_id'] !== 'direct'){
    				$data['biddata']		= 	$this->database->_get_bid($data['contract'][0]['bid_id']);
    			}
    			$data['contractamount']		= 	$this->database->_get_single_data('tbl_contracts',array('contract_id'=>$data['contract'][0]['id']),'amount');
    			$data['listing_data']		=	$this->database->_get_row_data('tbl_listings',array('id'=>$data['contract'][0]['listing_id']));
    		}
    		$data = $this->security->xss_clean($data);	
    		$this->load->view('user/open-contract',$data);
    		return;
    	}
    	$this->pageNotFound();
    }

    /*invoices*/
    public function invoices(){
    	$data = self::$data;
    	$data['invoices']	  	=	$this->database->_get_invoices();
    	$data = $this->security->xss_clean($data);	
    	$this->load->view('user/invoices',$data);
    	return;
    }

    /*view selected invoice*/
    public function invoice_get($id){
    	$data = self::$data;
    	if(!empty($id)){
    		$data['invoice']			=	$this->database->_get_row_data('tbl_invoices',array('invoice_id'=>$id));
    		if(!empty($data['invoice'])){
    			$data['customerinfo']	=	$this->database->getUserData($data['invoice'][0]['paid_by']);
    			$data['ownerinfo']		=	$this->database->getUserData($data['invoice'][0]['paid_to']);
    			$data['listing_data']	=	$this->database->_get_row_data('tbl_listings',array('id'=>$data['invoice'][0]['listing_id']));
    			$data = html_escape($this->security->xss_clean($data));
    			$this->load->view('user/invoice',$data);
    			return;
    		}
    	}
    	$this->pageNotFound();
    	return;
    }

	/*Get Selected Listing Header*/
	public function get_selectedListingHeader($header_id){
		$output['token']  = $this->security->get_csrf_hash();
        header('Content-Type: application/json');
        if(!empty($header_id)){
			$output['response']  = $this->database->_get_row_data('tbl_listing_header',array('listing_id'=>$header_id));
        	exit(json_encode($output));
		}

		$output['response']  = false;
        exit(json_encode($output));
	}

	/*Not found Page*/
	public function pageNotFound(){
		$this->load->view('main/404');
	}

	/*User logout*/
	public function logout(){
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('user_level');
		redirect($this->session->userdata('url'));
		return;
	}

	/*User Profile*/
	public function user_profile($userid,$page=0){
		$data = self::$data;
		$data['userprofile'] 					= 	$this->database->getUserData($userid);
		$data['reviewRatings'] 					= 	$this->database->get_reviews($userid,$this->session->userdata('user_id'));
		$data['profileid'] 						= 	$userid;
		$data['profileRatingsAvg'] 				= 	$this->database->get_reviews($userid,"","",'','','avg');
		$data["profileRatings"] 				= 	$this->database->get_reviews($userid,"","");
		$data['websitelistings'] 				= 	$this->_userwise__listings($userid,'');
		$data['soldlistings'] 					= 	$this->_userwise__listings($data['userprofile'][0]['user_id'],'',true,true);
		$data['listingCount']					= 	$this->database->_count_listings_user_wise();
		$data['totalEarnings']					=	$this->database->_user_total_earnings($userid);
		$data['verifiedGA']						=	"";
		$data['FormValues'] 					= 	"";
		$data['reportData'] 					= 	"";

		if(!empty($data['userprofile'])){
    		$data = html_escape($this->security->xss_clean($data));
    		$data["links"] 							= 	$this->common->reviews_pagination_loader($userid);
			$this->load->view('main/user-profile',$data);
			return;
		}
		$this->pageNotFound();
    	return;
	}

	/*Get Userwise Listings*/
    public function _userwise__listings($userid,$type='',$limit=false,$sold=false,$listing_id=''){
        if(!$limit){
        	$userListings = $this->database->_userwise_all_listings($userid,$type);
        }
        else
        {
        	if(empty($listing_id)){
        		if(!$sold){
        			$userListings = $this->database->_get_row_data('tbl_listings',array('user_id'=>$userid,'listing_option'=>$type),'',true);
        		}
        		else
        		{
        			return $userListings = $this->database->_get_row_data('tbl_listings',array('user_id'=>$userid,'status'=>1,'sold_status'=>1),'',false);
        		}
        	}
        	else
        	{
        		$userListings = $this->database->_get_row_data('tbl_listings',array('id'=>$listing_id,'user_id'=>$userid,'listing_option'=>$type),'',true);
        	}	
        }

        if(!empty($userListings)){
            $i=0;
            foreach ($userListings as $listing) {
            $userListings[$i]['listingType']            	= $listing['listing_type'];

            if($type === 'auction'){
                $userListings[$i]['activecount']            = $this->database->numberOfBids($listing['id'],$listing['listing_type'],'1',1);
                $userListings[$i]['inactivecount']          = $this->database->numberOfBids($listing['id'],$listing['listing_type'],'1',0);
                $userListings[$i]['rejectedcount']          = $this->database->numberOfBids($listing['id'],$listing['listing_type'],'1',2);
                $userListings[$i]['totalBids']              = $this->database->numberOfBids($listing['id'],$listing['listing_type'],'1',1);
               	$userListings[$i]['totalBidders']           = $this->database->numberOfBidders($listing['id'],$listing['listing_type'],'1',0);
               	$userListings[$i]['totalBidValue']          = array_sum(array_column($this->database->numberOfBids($listing['id'],$listing['listing_type'],'',1),'bid_amount'));
                $endingArr                                  = $this->common->DateDiffCalculate($this->database->_get_auction_ending_date($listing['id'],'tbl_listings')[0]['ENDDATE']);
                $userListings[$i]['endingdays']             = $endingArr['days'];
                $userListings[$i]['endinghours']            = $endingArr['hours'];
                $userListings[$i]['highestbid']             = 0;
                $userListings[$i]['highestbidder']          ='n/a';
                $userListings[$i]['averageBid']             = 0;
                $userListings[$i]['reservedprice']          = $this->database->_get_single_data('tbl_listings',array('id'=>$listing['id']),'website_reserveprice');
                $userListings[$i]['highestbidrow']          = 0;
                if(isset($userListings[$i]['activecount']) && $userListings[$i]['activecount'] !== 0){
                    $userListings[$i]['averageBid']         = $this->common->ConvertToMillions($userListings[$i]['totalBidValue'] / $userListings[$i]['activecount']);
                }
                
               	if(isset($this->DatabaseOperationsHandler->_get_highest_bid_details('1',$listing['id'],$listing['listing_type'])[0]['bid_amount'])){
                   	$userListings[$i]['highestbidrow']         = $this->database->_get_highest_bid_details('1',$listing['id'],$listing['listing_type'])[0]['bid_amount'];
                   	$userListings[$i]['highestbid']            = $this->common->ConvertToMillions($userListings[$i]['highestbidrow']);
                   	$userListings[$i]['highestbidder']         = $this->database->getUserData($this->DatabaseOperationsHandler->_get_highest_bid_details('1',$listing['id'],$listing['listing_type'])[0]['bidder_id'])[0]['username'];  
                }
            }
            else
            {
                $userListings[$i]['cancelcount']            = $this->database->numberOfOffers($listing['id'],$listing['listing_type'],'1',3);
                $userListings[$i]['inactivecount']          = $this->database->numberOfOffers($listing['id'],$listing['listing_type'],'1',0);
                $userListings[$i]['rejectedcount']          = $this->database->numberOfOffers($listing['id'],$listing['listing_type'],'1',1);
                $userListings[$i]['totalBids']              = $this->database->numberOfOffers($listing['id'],$listing['listing_type'],'1','');
                $userListings[$i]['totalBidders']           = $this->database->numberOfClients($listing['id'],$listing['listing_type'],'1',0);
                $userListings[$i]['totalBidValue']          = array_sum(array_column($this->database->numberOfOffers($listing['id'],$listing['listing_type'],'',1),'offer_amount'));
                $userListings[$i]['highestbid']             = 0;
                $userListings[$i]['highestbidder']          ='n/a';
                $userListings[$i]['averageBid']             = 0;
                $userListings[$i]['highestbidrow']          = 0;

                if(isset($userListings[$i]['activecount']) && $userListings[$i]['activecount'] !== 0){
                    $userListings[$i]['averageBid']         = $this->common->ConvertToMillions($userListings[$i]['totalBidValue'] / $userListings[$i]['activecount']);
                }
                
                if(isset($this->database->_get_highest_offer_details('0',$listing['id'],$listing['listing_type'])[0]['offer_amount'])){
                    $userListings[$i]['highestbidrow']          = $this->database->_get_highest_offer_details('0',$listing['id'],$listing['listing_type'])[0]['offer_amount'];
                    $userListings[$i]['highestbid']             = $this->common->ConvertToMillions($userListings[$i]['highestbidrow']);
                    $userListings[$i]['highestbidder']          = $this->database->getUserData($this->DatabaseOperationsHandler->_get_highest_offer_details('0',$listing['id'],$listing['listing_type'])[0]['customer_id'])[0]['username'];  
                }
            }
            $i++; 
        }
           return $userListings;
        }
        return;
    }

    /*Update the Bid Status After Finish the Auction*/
    public function _update_winning_auction($id,$type){

        $data['AuctionEndingDate']     	= $this->database->_get_auction_ending_date($id,'tbl_listings');
        $expire 						= $data['AuctionEndingDate'][0]['ENDDATE'];
        $today  						= strtotime("today");

        if($today <= $expire){
            $aleadyExists                           = $this->_get_highest_bid_details('3',$id,$type);
            if(empty($aleadyExists)){
                $HighestBidInfo                     = $this->_get_highest_bid_details('1',$id,$type);
                if(isset($HighestBidInfo[0]['bid_amount'])){
                    if(!empty($HighestBidInfo[0]['id']) && isset($HighestBidInfo[0]['id'])) {
                        $data = array(
                        'bid_status' => 3
                        );
                        return $this->database->_update_to_table('tbl_bids',$data,array('id'=>$HighestBidInfo[0]['id']));
                    }   
                }     
            }
        }
        return;
    }

    /*Revoke Tokens*/
    public function revokeTokens($domain){
    	$data= array(
            'acc_id' =>"",
            'prop_id' =>"",
            'view_id' =>"",
            'google_token' =>"",
            'google_anastatus' =>0
        );
        if($this->database->_update_to_table('tbl_domains',$data,array('id'=>$domain,'status'=>1))){
        	return true;
        }
        else
        {
        	return false;
        }
    }

    /*Create Withdrawal Record*/
    public function create_withdrawal(){
    	$output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

    	$datas = self::$data;
        $withdrawalDetails      = $this->database->_get_row_data('tbl_withdrawal_methods',array('id'=>$this->input->post('withdrawal_method'),'status'=>1));
        $availableToWithdraw    = $this->database->_user_availableto_withdraw($this->session->userdata('user_id'));

        if($availableToWithdraw < $this->input->post('withdraw_amount')){
            $output['response'] ='Sorry You can withdraw only $'.$availableToWithdraw;
            exit(json_encode($output)); 
        }

        if($withdrawalDetails[0]['threshold'] > $this->input->post('withdraw_amount')){
            $output['response'] ='Sorry Your Withdrawal Threshold for this method is $'.$withdrawalDetails[0]['threshold'];
            exit(json_encode($output));
        }

        $fee = $withdrawalDetails[0]['fee'];
        if($withdrawalDetails[0]['cal_meth'] === '1'){
            $fee = ($this->input->post('withdraw_amount') * $withdrawalDetails[0]['fee']) / 100;
        }

        $data = array(
          'withdrawal_id' =>$this->database->_unique_id('tbl_withdrawals','alnum','withdrawal_id'),
          'user_id' => $this->session->userdata('user_id'),
          'updated' => date('Y-m-d H:i:s'),
          'amount' => $this->input->post('withdraw_amount'),
          'fee' => $fee,
          'final_amount' => ($this->input->post('withdraw_amount') - $fee),
          'method' => $this->input->post('withdrawal_method'),
          'status' => 0
        );

        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('amount', 'Withdrawal Amount', 'required|numeric|trim|xss_clean');

        if ($this->form_validation->run()){
            $data = $this->security->xss_clean($data);
			if($datas['settings'][0]['email_notifications'] === '1'){
        		$this->email_op->_admin_email_notification('withdraw-request',$data);
        	}

        	$output['response']     = 	$this->database->_insert_to_table('tbl_withdrawals',$data);
        	exit(json_encode($output)); 
        }

        $output['response']         = 	'Sorry, right now we cannot process your request. Please contact support';
        exit(json_encode($output)); 
    }

    /*Insert domain purchases*/
    public function InsertDomainPurchaseData($user_id,$Arr){
        if(!empty($Arr['domain_list'])){
            foreach (json_decode($Arr['domain_list'],true) as $domain) {
            $domain_id  =	$this->database->_get_single_data('tbl_listings',array('id'=>$domain['id']),'domain_id');
            if($domain['sale'] === 'direct'){
               	$data= array(
                    'user_id' =>$user_id,
                   	'domain_id' =>$domain_id,
                    'listing_id' =>$domain['id'],
                    'amount' =>$domain['price'],
                    'invoice_id' =>$Arr['transactionId'],
                );

                $contract_id = $this->common->open_direct_contract($data['listing_id']);

                $contractArr= array(
                    'user_id' =>$user_id,
                    'domain_id' =>$domain_id,
                    'contract_id' =>$contract_id,
                    'listing_id' =>$domain['id'],
                    'amount' =>$domain['price'],
                    'invoice_id' =>$Arr['transactionId'],
                );

                if($this->database->_update_to_DB('tbl_listings',array('sold_status' => 1),$data['listing_id'])){
                    if(!empty($contract_id)){
                    	$this->database->_insert_to_table('tbl_domain_purchases',$data);
                        if($this->database->_insert_to_table('tbl_contracts',$contractArr)){
                            $this->common->change_contract_status($contract_id,1);
                            $this->common->change_delivery_date($contract_id,1);
                            $this->common->create_invoice($contractArr);
                        }
                    }
                }
            }
            else
            {
                $data= array(
                    'user_id' =>$user_id,
                    'domain_id' =>$domain_id,
                   	'contract_id' =>$domain['sale'],
                    'listing_id' =>$domain['id'],
                    'amount' =>$domain['price'],
                    'invoice_id' =>$Arr['transactionId'],
                );

                if($this->database->_update_to_DB('tbl_listings',array('sold_status' => 1),$data['listing_id'])){
                    if($this->database->_insert_to_table('tbl_contracts',$data)){
                        $this->common->change_contract_status($domain['sale'],1);
                        $this->common->change_delivery_date($domain['sale'],1);
                        $this->common->create_invoice($data);
                    }
                }
            }
        	}
        }
    }

    /*Insert Report*/
    public function insert_report(){
    	$output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        $data = array(
        'listing_id	' => $this->input->post('listing_id'),
        'reporter' => $this->session->userdata('user_id'),
        'reason' => $this->input->post('txt_reason'),
        'status' => 0
        );

        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('reason', 'reason', 'required|trim|xss_clean');

        if ($this->form_validation->run()) {
        	$data = html_escape($this->security->xss_clean($data));
        	$output['response']     = $this->database->_insert_to_table('tbl_reports',$data);
			exit(json_encode($output));
        }

        $output['response']         = false;
        exit(json_encode($output));
    }

    /*Insert Comments*/
    public function insert_comment(){
    	$output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

        $data = array(
        'user_id' => $this->input->post('logged_user'),
        'listing_id' => $this->input->post('comment_listing'),
        'body' => $this->input->post('write_comment'),
        'author_comment' => $this->input->post('author_comment'),
        'section' => $this->input->post('comment_section'),
        'status' => 1
        );

        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('body', 'comment', 'required|trim|xss_clean');

        if ($this->form_validation->run()) {
        	$data = html_escape($this->security->xss_clean($data));
        	$output['response']     = $this->database->_insert_to_table('tbl_comments',$data);
			exit(json_encode($output));
        }

        $output['response']         = false;
        exit(json_encode($output));
    }

    /*Save Ad Listings*/
	public function add_listing(){
		$output['token']       = $this->security->get_csrf_hash();
        header('Content-Type: application/json');

		$deviceData     	= $this->common->detectVisitorDevice();
		$thumbnailCover 	= '';
		$thumbnail      	= '';
		$uploadVisual   	= '';
		$uploadProfitLoss   = '';

		$output['token']  	= $this->security->get_csrf_hash();
		header('Content-Type: application/json');

		if(empty($this->input->post('listing_type'))){
			$output['response']  =  false;
            exit(json_encode($output));
		}

		if($this->input->post('listing_type') === 'domain'){
           	
        	if (!empty($_FILES['uploadThumbnailImage']['name'])) {
            	if($this->security->xss_clean($_FILES['uploadThumbnailImage']['name'], TRUE) === TRUE) {
                	$thumbnail = $this->upload__image('uploadThumbnailImage');
            	}
        	}

        	if(empty($this->input->post('listing_id'))){
        		if($this->input->post('website_1_group_2') === 'classified'){
            		$listing_option = 'classified';
        		}
        		else if($this->input->post('website_1_group_2') === 'auction'){
            		$listing_option = 'auction';
        		}
        	}
        	else
        	{
        		$listing_option = $this->input->post('listing_option');
        	}

        	$extesnion = explode(".", $this->input->post('website_BusinessName'));

        	$data = array(
          	'domain_id' => $this->input->post('domain_id'),
          	'listing_type' => $this->input->post('listing_type'),
          	'user_id' => $this->session->userdata('user_id'),
          	'website_BusinessName' => $this->input->post('website_BusinessName'),
          	'extension' => end($extesnion),
          	'website_age' => $this->input->post('website_age'),
          	'business_registeredCountry' => $this->input->post('business_registeredCountry'),
          	'website_industry' => "",
          	'monetization_methods' => 'N/A',
          	'last12_monthsrevenue' => "",
          	'last12_monthsexpenses' => "",
          	'annual_profit' => "",
          	'google_verified' => 0,
          	'financial_uploadVisual' => "",
          	'financial_uploadProfitLoss' => "",
          	'website_tagline' => $this->input->post('website_tagline'),
          	'website_metadescription' => $this->input->post('website_metadescription'),
          	'website_metakeywords' => json_encode(explode(",",$this->input->post('website_metakeywords'))),
          	'description' => $this->input->post('editordata'),
          	'website_how_make_money' => "",
          	'website_purchasing_fulfilment' => "",
          	'website_whyselling' => "",
          	'website_suitsfor' => "",
          	'website_thumbnail' =>  $thumbnail,
          	'website_cover' => "",
          	'status' => 0,
          	'sold_status' => 0,
          	'deliver_in' => $this->input->post('deliver_in'),
          	'listing_option' => $listing_option,
          	'website_startingprice' => $this->input->post('website_startingprice'),
          	'website_reserveprice' => $this->input->post('website_reserveprice'),
          	'website_minimumoffer' => $this->input->post('website_minimumoffer'),
          	'website_buynowprice' => $this->input->post('website_buynowprice'),
          	'user_ip' => $deviceData['ip_address'],
          	'date' => date('Y-m-d H:i:s'),
          	'token' => ''
        	);

        	$dataUp = array(
          	'website_tagline' => $this->input->post('website_tagline'),
          	'website_metadescription' => $this->input->post('website_metadescription'),
          	'description' => $this->input->post('editordata'),
          	'website_age' => $this->input->post('website_age'),
          	'business_registeredCountry' => $this->input->post('business_registeredCountry')
        	);
       	}
       	else
       	{
        	if (!empty($_FILES['uploadListingImage']['name'])) {
            	if($this->security->xss_clean($_FILES['uploadListingImage']['name'], TRUE) === TRUE) {
                	$thumbnailCover = $this->upload__image('uploadListingImage');
            	}
        	}

        	if (!empty($_FILES['uploadThumbnailImage']['name'])) {
            	if($this->security->xss_clean($_FILES['uploadThumbnailImage']['name'], TRUE) === TRUE) {
                	$thumbnail = $this->upload__image('uploadThumbnailImage');
            	}
        	}

        	if (!empty($_FILES['uploadVisual']['name'])) {
            	if($this->security->xss_clean($_FILES['uploadVisual']['name'], TRUE) === TRUE) {
                	$uploadVisual = $this->upload__files('uploadVisual');
            	}
        	}

        	if (!empty($_FILES['uploadProfitLoss']['name'])) {
            	if($this->security->xss_clean($_FILES['uploadProfitLoss']['name'], TRUE) === TRUE) {
                	$uploadProfitLoss = $this->upload__files('uploadProfitLoss');
            	}
        	}

            if(empty($this->input->post('listing_id'))){
            	if($this->input->post('website_1_group_2') === 'classified'){
                	$listing_option = 'classified';
            	}
            	else if($this->input->post('website_1_group_2') === 'auction'){
                	$listing_option = 'auction';
            	}
            }
            else
            {
            	$listing_option = $this->input->post('listing_option');
            }

            $extesnion = explode(".", $this->input->post('website_BusinessName'));
            
            $data = array(
            'domain_id' => $this->input->post('domain_id'),
            'listing_type' => $this->input->post('listing_type'),
            'user_id' => $this->session->userdata('user_id'),
            'website_BusinessName' => $this->input->post('website_BusinessName'),
            'extension' => end($extesnion),
            'website_age' => $this->input->post('website_age'),
            'business_registeredCountry' => $this->input->post('business_registeredCountry'),
            'website_industry' => $this->input->post('website_industry'),
            'monetization_methods' => 'N/A',
            'last12_monthsrevenue' => $this->input->post('last12_monthsrevenue'),
            'last12_monthsexpenses' => $this->input->post('last12_monthsexpenses'),
            'annual_profit' => $this->input->post('annual_profit'),
            'google_verified' => 0,
            'financial_uploadVisual' => $uploadVisual,
            'financial_uploadProfitLoss' => $uploadProfitLoss,
            'website_tagline' => $this->input->post('website_tagline'),
            'website_metadescription' => $this->input->post('website_metadescription'),
            'website_metakeywords' => json_encode(explode(",",$this->input->post('website_metakeywords'))),
            'description' => $this->input->post('editordata'),
            'website_how_make_money' => $this->input->post('website_how_make_money'),
            'website_purchasing_fulfilment' => $this->input->post('website_purchasing_fulfilment'),
            'website_whyselling' => $this->input->post('website_whyselling'),
            'website_suitsfor' => $this->input->post('website_suitsfor'),
            'website_thumbnail' =>  $thumbnail,
            'website_cover' => $thumbnailCover,
            'status' => 0,
            'sold_status' => 0,
            'deliver_in' => $this->input->post('deliver_in'),
            'listing_option' => $listing_option,
            'website_startingprice' => $this->input->post('website_startingprice'),
            'website_reserveprice' => $this->input->post('website_reserveprice'),
            'website_minimumoffer' => $this->input->post('website_minimumoffer'),
            'website_buynowprice' => $this->input->post('website_buynowprice'),
            'user_ip' => $deviceData['ip_address'],
            'date' => date('Y-m-d H:i:s'),
            'token' => ''
            );

            $dataUp = array(
          	'website_tagline' => $this->input->post('website_tagline'),
          	'website_metadescription' => $this->input->post('website_metadescription'),
          	'website_age' => $this->input->post('website_age'),
          	'business_registeredCountry' => $this->input->post('business_registeredCountry'),
          	'description' => $this->input->post('editordata'),
          	'website_industry' => $this->input->post('website_industry'),
          	'last12_monthsrevenue' => $this->input->post('last12_monthsrevenue'),
          	'last12_monthsexpenses' => $this->input->post('last12_monthsexpenses'),
          	'website_how_make_money' => $this->input->post('website_how_make_money'),
          	'website_purchasing_fulfilment' => $this->input->post('website_purchasing_fulfilment'),
          	'website_whyselling' => $this->input->post('website_whyselling'),
          	'website_suitsfor' => $this->input->post('website_suitsfor')
        	);
       	}

       	if(empty($this->input->post('listing_id'))){
       		$data = $this->security->xss_clean($data);	
           	$data['id']  = $this->database->_insert_to_DB('tbl_listings',$data);
           	if(!empty($data['id'])){
            	$output['response']  =  $data;
                exit(json_encode($output));
            }
            else
            {
            	$output['response']  =  false;
                exit(json_encode($output));
            }
        }
        else
        {
        	if(!empty($thumbnailCover)){
        		$dataUp['website_cover'] = $thumbnailCover;
        	}
        	if(!empty($thumbnail)){
        		$dataUp['website_thumbnail'] = $thumbnail;
        	}
        	if(!empty($uploadVisual)){
        		$dataUp['financial_uploadVisual'] = $uploadVisual;
        	}
        	if(!empty($uploadProfitLoss)){
        		$dataUp['financial_uploadProfitLoss'] = $uploadProfitLoss;
        	}
        	
        	$dataUp = array_map("html_entity_decode",html_escape($this->security->xss_clean($dataUp)));
           	$output['response']  =  $this->database->_update_to_DB('tbl_listings',$dataUp,$this->input->post('listing_id'));
            exit(json_encode($output));
        }
	}
}