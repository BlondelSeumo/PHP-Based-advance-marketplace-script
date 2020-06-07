<?php defined('BASEPATH') OR exit('No direct script access allowed');

class DatabaseOperationsHandler extends CI_Model
{
	function __construct(){
		parent::__construct();
        $this->load->database();
	}

	/*Load all settings data*/
    public function getSettingsData(){
        $this->db->where('id',1);
        $query = $this->db->get('tbl_settings');
        return $query->result_array();
    }

    /*Load Userdata*/
    public function getUserData($user_id){
        $this->db->where('user_id',$user_id);
        $query = $this->db->get('tbl_users');

        if(!empty($query->result_array())){
            return $query->result_array();
        }
        else{
            $this->db->where('username',$user_id);
            $query = $this->db->get('tbl_users');
            return $query->result_array();
        }
    }

	/*Load All Languages*/
    public function load_all_languages($json=false){
        $this->db->where('status',1);
        $query = $this->db->get('tbl_languages');
        return $query->result_array();
    }

    /*Get Default Language*/
    public function GetDefaultLanguage(){
        $this->db->where('default_status','1');
        $query = $this->db->get('tbl_languages');
        return $query->result_array();
    }

	/*Login User*/
    public function LoginUser(){
        $this->db->or_where('username',$this->input->post('login_username'));
        $this->db->or_where('email',$this->input->post('login_username'));
        $query = $this->db->get('tbl_users');
        if(isset($query->result_array()[0]['user_id'])){
            if(!empty($this->input->post('login_password'))){
                if($query->result_array()[0]['password'] == md5(trim($this->input->post('login_password')))){
                    return $query->result_array();
                }
            }
        }
        return;
    }

    /*Get User Related Contracts*/
    public function _get_my_contracts($open=true){
        $ignore = array(0,1,2,3,5,6,8,9);
        if($open){
            $ignore = array(4, 7);
        } 
        $this->db->where_not_in('status', $ignore);
        $this->db->group_start();
        $this->db->where('owner_id',$this->session->userdata('user_id'));
        $this->db->or_where('customer_id',$this->session->userdata('user_id'));
        $this->db->group_end();
        $query = $this->db->get('tbl_opens');
        return $query->result_array();
    }

    /*Count website Listings Userwise*/
    public function _count_listings_user_wise($listing_option=""){
        $this->db->where('user_id',$this->session->userdata('user_id'));
        $this->db->where('status',1);
        if(!empty($listing_option)) {
            $this->db->where('listing_option',$listing_option);
        }
        $query  = $this->db->get('tbl_listings');
        return $query->num_rows();
    }

    /*Registration Availability Checks*/
    public function RegistrationAvailabilityChecks($table,$column,$value){
        $this->db->where($column,$value);
        $query = $this->db->get($table);
        if($query->num_rows() > 0){
            exit(json_encode('false'));
        }
        exit(json_encode('true'));
    }

    /*Change User Table*/
    public function ChangeUserOnlineStatus($column){
        $data = array(
        $column => $this->input->post('status')
        );
        $this->db->where('user_id',$this->session->userdata('user_id'));
        return $this->db->update('tbl_users', $data);
    }

    /* Existing Listing Domain Check*/
    public function CheckAlreadyExists($table_name,$data,$exclude=''){
        $this->db->from($table_name);
        $this->db->where($data); 
        
        if(!empty($include)){
            $this->db->where_not_in('user_id',$exclude);
        }

        $query = $this->db->get();
        return $query->num_rows();
    }

    /* Return Single Column Value*/
    public function _get_single_data($table_name,$data,$returnVal){
        $this->db->from($table_name);
        $this->db->where($data);
        $query = $this->db->get();
        $ret = $query->row();
        if(!empty($ret)){
            return $ret->$returnVal;
        }
        return;
    }

    /* Return Row Data Array*/
    public function _get_row_data($table_name,$data,$limit='',$status_limit=false,$or_condition=''){
        if(!empty($data)){
            $this->db->group_start();
            $this->db->where($data);
            if(!empty($or_condition)){
                $this->db->or_where($or_condition);
            }
            $this->db->group_end();
        }
        if(!empty($limit)){
            $query = $this->db->get($table_name,$limit);
            return $query->result_array();
        }

        if($status_limit){
            $this->db->where_not_in('status',array(0,6));
        }

        $query = $this->db->get($table_name);
        return $query->result_array();
    }

    /*Insert Data to Database*/
    public function _insert_to_DB($table,$data){
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    /*Insert to Table*/
    public function _insert_to_table($table,$data){
        return $this->db->insert($table, $data);
    }

    /*Update Table */
    public function _update_to_DB($table,$data,$update_id){
        $this->db->where('id',$update_id);
        return $this->db->update($table, $data);
    }

    /*Update Given Column Table */
    public function _update_to_table($table,$data,$conditions){
        $this->db->where($conditions);
        return $this->db->update($table, $data);
    }

    /*Delete Data from Table */
    public function _delete_from_table($table,$conditions){
        $this->db->where($conditions);
        return $this->db->delete($table);
    }

    /* Results Count*/
    public function _results_count($table,$condition,$count=false){
        if($count){
            return $this->db
            ->where($condition)
            ->count_all_results($table);
        }

        return $this->db
            ->where($condition)
            ->count_all_results($table) > 0;
    }

    /* Results Count Multiple*/
    public function _multiple_results_count($table,$key,$condition,$count=false){
        if($count){
            return $this->db
            ->where_in($condition)
            ->count_all_results($table);
        }

        return $this->db
            ->where_in($key,$condition)
            ->count_all_results($table) > 0;
    }

    /*get statics data*/
    public function _get_statics($table,$select,$condition,$or_condition='',$distinct='',$like=''){
        $this->db->select($select);
        $this->db->group_start();
        $this->db->where($condition);
        if(!empty($or_condition)){
            $this->db->or_where($or_condition);
        }
        $this->db->group_end();
        if(!empty($like)){
            $this->db->like($like);
        }

        if(!empty($distinct)) {
            $this->db->distinct($distinct);
        }    
        $query = $this->db->get($table);
        return $query->result_array();
    }


    /*Update Domain Token Old */
    public function _update_domain_token_old($data){
        $this->db->where('domain',$data['domain']);
        $this->db->where('user_id',$data['user_id']);
        $this->db->where('token',$data['token']);
        if($this->db->update('tbl_domains', array('status' => 1))){
            $this->db->group_start();
            $this->db->where('domain',$data['domain']);
            $this->db->where_not_in('user_id',$data['user_id']);
            $this->db->where_not_in('token',$data['token']); 
            $this->db->group_end();           
            return $this->db->update('tbl_domains', array('status' => 0));
        }
    }

    /*Update Domain Token New */
    public function _update_domain_token($data){
        $this->db->where('domain',$data['domain']);
        $this->db->where('user_id',$data['user_id']);
        $this->db->where('token',$data['token']);

        if($this->db->update('tbl_domains', array('status' => 1))){
            //UPDATE OTHER DOMAINS AS UNVERIFIED
            $this->db->group_start();
            $this->db->where('domain',$data['domain']);
            $this->db->where_not_in('user_id',$data['user_id']);
            $this->db->where_not_in('token',$data['token']); 
            $this->db->group_end();
            $domain_data = $this->db->get('tbl_domains',1)->row();
            if(!empty($domain_data)){
                $domain_id = $domain_data->id;

                $dom_auto_arr= array(
                'status' =>0,
                'acc_id' =>"",
                'prop_id' =>"",
                'view_id' =>"",
                'google_token' =>"",
                'google_anastatus' =>0
                );

                $this->db->where('id',$domain_id);      
                $this->db->update('tbl_domains', $dom_auto_arr);
            }
       
            if(!empty($domain_id)){
                $listing_id = $this->_get_single_data('tbl_listings',array('domain_id' => $domain_id),'id');
                if(!empty($listing_id)){
                    $contract_id = $this->_get_single_data('tbl_opens',array('listing_id' => $listing_id),'contract_id');
                    $status      = $this->_get_single_data('tbl_opens',array('contract_id' => $contract_id),'status');

                    if(empty($contract_id)){
                        return $this->_update_to_table('tbl_listings',array('status'=>5),array('id' => $listing_id));
                    }

                    if($status !== 4 && $status !== 5){
                        $data = array(
                        'status' =>7,
                        'contract_id' => $contract_id,
                        'remarks' => 'Domain Ownership Changed',
                        'uploads' => '',
                        'user' => $this->_get_single_data('tbl_listings',array('id' => $listing_id),'user_id')
                        );

                        if($this->_insert_to_table('tbl_history',$data)){
                            if($this->_update_to_table('tbl_opens',array('status'=>7,'date'=>date('Y-m-d H:i:s')),array('contract_id'=>$contract_id))){
                                $invoice_id  = $this->_get_single_data('tbl_contracts',array('contract_id'=>$contract_id),'invoice_id');
                                $data = array(
                                'status' => 3,
                                'updated'=>date('Y-m-d H:i:s')
                                );
                                $this->_update_to_table('tbl_invoices',$data,array('invoice_id'=>$invoice_id));
                                return $this->_update_to_table('tbl_listings',array('status'=>5),array('domain_id' => $domain_id));
                            }
                        }
                    }
                    else
                    {
                        if($status === 5){
                            $customer_id    = $this->_get_single_data('tbl_opens',array('contract_id' => $contract_id),'customer_id');
                            if($customer_id === $this->session->userdata('user_id')) {
                                $data = array(
                                'status' =>4,
                                'contract_id' => $contract_id,
                                'remarks' => 'Accepted Delivery Automatically',
                                'uploads' => '',
                                'user' => $this->_get_single_data('tbl_listings',array('id' => $listing_id),'user_id')
                                );

                                if($this->_insert_to_table('tbl_history',$data)){
                                    if($this->_update_to_table('tbl_opens',array('status'=>4,'date'=>date('Y-m-d H:i:s')),array('contract_id'=>$contract_id))){
                                        $invoice_id  = $this->_get_single_data('tbl_contracts',array('contract_id'=>$contract_id),'invoice_id');
                                        $data = array(
                                        'status' => 4,
                                        'updated'=>date('Y-m-d H:i:s')
                                        );
                                        return $this->_update_to_table('tbl_invoices',$data,array('invoice_id'=>$invoice_id));
                                    }
                                }
                            }
                            else
                            {
                                $data = array(
                                'status' =>7,
                                'contract_id' => $contract_id,
                                'remarks' => 'Domain Ownership Changed',
                                'uploads' => '',
                                'user' => $this->_get_single_data('tbl_listings',array('id' => $listing_id),'user_id')
                                );

                                if($this->_insert_to_table('tbl_history',$data)){
                                    if($this->_update_to_table('tbl_opens',array('status'=>7,'date'=>date('Y-m-d H:i:s')),array('contract_id'=>$contract_id))){
                                        $invoice_id  = $this->_get_single_data('tbl_contracts',array('contract_id'=>$contract_id),'invoice_id');
                                        $data = array(
                                        'status' => 3,
                                        'updated'=>date('Y-m-d H:i:s')
                                        );
                                        $this->_update_to_table('tbl_invoices',$data,array('invoice_id'=>$invoice_id));
                                        return $this->_update_to_table('tbl_listings',array('status'=>5),array('domain_id' => $domain_id));
                                    }   
                                }
                            }   
                        }
                        else if($status === 4){
                            return true;
                        }
                    }
                }
            }
            return true;
        }
    }

    /*Create a Verification File*/
    public function createVerificationFile($dataArr){
        $this->load->helper('file');
        $this->load->library('zip');
        $name = $dataArr['token'].'.txt';
        $data = $dataArr['token'];
        $this->zip->add_data($name, $data);
        if($this->zip->archive(VERIFICATION_FILE.$dataArr['token'].'.zip')){
            return true;
        }
        else
        {
            return false;
        }
    }

    /*Generate Unique IDs*/
    public function _unique_id($table='tbl_opens',$method='alnum',$condition){
        do{
           $new_key = random_string($method, 8);
        }
        while ($this->_results_count($table,array($condition=>$new_key)));
        return $new_key;
    }

    /*Get Userwise All Listings*/
    public function _userwise_all_listings($userid,$type=''){
        $Arr = array();

        if(!empty($userid)){
            $this->db->where('user_id',$userid);
        }

        if(!empty($type)){
            $this->db->where('listing_option',$type);
        }
        $this->db->where_not_in('status',array(0,6));
        $query  = $this->db->get('tbl_listings');
        $Arr    = $query->result_array();
        if(empty($Arr)){
            $Arr = array();
            $this->db->join('tbl_users', 'tbl_users.user_id = tbl_listings.user_id'); 
            $this->db->where('tbl_users.username',$userid);
            $this->db->where_not_in('tbl_listings.status',0);
            $query  = $this->db->get('tbl_listings');
            $Arr    = $query->result_array();
        }
        return $Arr;
    }

    /*Get no of Bids ListingsWise*/
    public function numberOfBids($listing_id,$type,$count='',$status){
        $this->db->where('listing_id',$listing_id);
        $this->db->where('listing_type',$type);
        if(!empty($status)){
            $this->db->where('bid_status',$status);
            $this->db->or_where('bid_status','3');
        }
        $query = $this->db->get('tbl_bids');
        if(empty($count)){
            return $query->result_array();
        }
        return $query->num_rows();
    }

    /*Get no of Offers ListingsWise*/
    public function numberOfOffers($listing_id,$type,$count="",$status){
        $this->db->where('listing_id',$listing_id);
        $this->db->where('listing_type',$type);
        if(!empty($status)){
            $this->db->group_start();
            $this->db->where('offer_status',$status);
            $this->db->or_where('offer_status','2');
            $this->db->group_end();
        }
        $query = $this->db->get('tbl_offers');
        if(empty($count)){
            return $query->result_array();
        }
        return $query->num_rows();
    }

    /*Get Highest Bid Details*/
    public function _get_highest_bid_details($status='1',$listing_id='',$listing_type=''){
        if(empty($listing_id)){
            $this->db->where('listing_id',$this->input->post('bid_listing_id'));
        }
        else
        {
            $this->db->where('listing_id',$listing_id);
        }

        if(empty($listing_type)){
            $this->db->where('listing_type',$this->input->post('bid_listing_type'));
        }
        else
        {
            $this->db->where('listing_type',$listing_type);
        }
        $this->db->where('bid_status ',$status);
        if($status !== '3'){
            $this->db->or_where('bid_status ','3');
        }
        $this->db->order_by('bid_amount', 'desc');
        $this->db->limit(1);
        $query = $this->db->get('tbl_bids');
        return $query->result_array();
    }

    /*Get Highest Offer Details*/
    public function _get_highest_offer_details($status='1',$listing_id='',$listing_type=''){
        if(empty($listing_id)){
            $this->db->where('listing_id',$this->input->post('bid_listing_id'));
        }
        else
        {
            $this->db->where('listing_id',$listing_id);
        }

        if(empty($listing_type)){
            $this->db->where('listing_type',$this->input->post('bid_listing_type'));
        }
        else
        {
            $this->db->where('listing_type',$listing_type);
        }
        
        $this->db->where('offer_status ',$status);
        if($status !== '2'){
            $this->db->or_where('offer_status ','2');
        }
        $this->db->order_by('offer_amount', 'desc');
        $this->db->limit(1);
        $query = $this->db->get('tbl_offers');
        return $query->result_array();
    }

    /*Get no of Bidders ListingsWise*/
    public function numberOfBidders($listing_id,$type,$count="",$status){
        $this->db->where('listing_id',$listing_id);
        $this->db->where('listing_type',$type);
        $this->db->where('bid_status',$status);
        $this->db->group_by('bidder_id');
        $query = $this->db->get('tbl_bids');
        if(empty($count)){
            return $query->result_array();
        }
        return $query->num_rows();
    }

    /*Auction Ending Date*/
    public function _get_auction_ending_date($id,$table='tbl_listings'){
        $this->db->select('DATE_ADD(date, INTERVAL '.$this->getSettingsData()[0]['auction_period'].' DAY) AS ENDDATE ', FALSE);
        $this->db->where('id',$id);
        $query = $this->db->get($table);
        return $query->result_array();
    }

    /*Get Bids UserDetails*/
    public function _get_all_offers($listing_id,$status='0',$type,$sort="tbl_offers.offer_amount",$order='DESC',$reviews="",$owner='on'){
        $this->db->select('*,DATEDIFF(CURRENT_DATE(), tbl_offers.date) AS nfd,(tbl_offers.date) as offer_date');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_offers.customer_id');

        if(!empty($reviews)){
        }

        $this->db->where('tbl_offers.listing_id',$listing_id);
        $this->db->where('tbl_offers.listing_type',$type);
        $this->db->where('tbl_offers.offer_status',$status);
        $this->db->or_where('tbl_offers.offer_status','2');
        
        if($owner === 'on'){
             $this->db->where('tbl_offers.owner_id',$this->session->userdata('user_id'));
        }
       
        $this->db->order_by($sort, $order);
        $query      = $this->db->get('tbl_offers');
        $dataArr    = $query->result_array();

        if(!empty($dataArr)){
            $i=0;
            foreach ($dataArr as $key) {
                $dataArr[$i]['ago']                             = $this->CommonOperationsHandler->time_elapsed_string($key['offer_date']);
                $dataArr[$i]['ratings']                         = number_format($this->get_reviews($key['customer_id'],"","","","",'avg')[0]['avg_r'],1);
                $reservedPrice                                  = $this->database->_get_single_data('tbl_listings',array('id'=>$key['listing_id'],'status'=>1),'website_reserveprice');

                if($key['offer_amount'] > $reservedPrice){
                    $dataArr[$i]['reserve']                     = 1;
                }
                else {
                    $dataArr[$i]['reserve']                     = 0;   
                }

                $HighestBidInfo                                 = $this->_get_highest_offer_details('0',$key['listing_id'],$key['listing_type']);

                if(isset($HighestBidInfo[0]['offer_amount'])){
                    if($HighestBidInfo[0]['id'] === $key['id']) {
                        $dataArr[$i]['highestbid']              = $this->CommonOperationsHandler->ConvertToMillions($HighestBidInfo[0]['offer_amount']);
                        $dataArr[$i]['highestbidder']           = $this->getUserData($HighestBidInfo[0]['customer_id'])[0]['username']; 
                        $dataArr[$i]['highestbidderid']         = $HighestBidInfo[0]['customer_id'];
                    }
                }

                $i++;
            }
        }
        return ($dataArr);
    }

    /*Get Bids UserDetails*/
    public function _get_all_bids($listing_id,$status='1',$type,$sort="tbl_bids.bid_amount",$order='DESC',$reviews="",$owner='on'){
        $this->db->select('*,DATEDIFF(CURRENT_DATE(), tbl_bids.date) AS nfd,(tbl_bids.date) as bid_date');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_bids.bidder_id');

        if(!empty($reviews)){
        }

        $this->db->where('tbl_bids.listing_id',$listing_id);
        $this->db->where('tbl_bids.listing_type',$type);
        $this->db->where('tbl_bids.bid_status',$status);
        $this->db->or_where('tbl_bids.bid_status','3');
        
        if($owner === 'on'){
            $this->db->where('tbl_bids.owner_id',$this->session->userdata('user_id'));
        }
       
        $this->db->order_by($sort, $order);
        $query      = $this->db->get('tbl_bids');
        $dataArr    = $query->result_array();

        if(!empty($dataArr)){
            $i=0;
            foreach ($dataArr as $key) {
                $dataArr[$i]['ago']                             = $this->CommonOperationsHandler->time_elapsed_string($key['bid_date']);
                $dataArr[$i]['ratings']                         = number_format($this->get_reviews($key['bidder_id'],"","","","",'avg')[0]['avg_r'],1);
                $reservedPrice                                  = $this->database->_get_single_data('tbl_listings',array('id'=>$key['listing_id'],'status'=>1),'website_reserveprice');
                if($key['bid_amount'] > $reservedPrice){
                    $dataArr[$i]['reserve']                     = 1;
                }
                else {
                    $dataArr[$i]['reserve']                     = 0;   
                }

                $HighestBidInfo                                 = $this->_get_highest_bid_details('1',$key['listing_id'],$key['listing_type']);

                if(isset($HighestBidInfo[0]['bid_amount']))
                {
                    if($HighestBidInfo[0]['id'] === $key['id']) {
                        $dataArr[$i]['highestbid']              = $this->CommonOperationsHandler->ConvertToMillions($HighestBidInfo[0]['bid_amount']);
                        $dataArr[$i]['highestbidder']           = $this->getUserData($HighestBidInfo[0]['bidder_id'])[0]['username']; 
                        $dataArr[$i]['highestbidderid']         = $HighestBidInfo[0]['bidder_id'];
                    }
                }
                $i++;
            }
        }
        return ($dataArr);
    }

    /*Get review info*/
    public function get_reviews($profile_id="",$user_id="",$count="",$limit=4,$start=0,$condition=""){
        if(!empty($profile_id)){
            $userProfile = $this->getUserData($profile_id);
        }

        if(!empty($condition) && $condition === 'avg'){
            $this->db->select('*,AVG(ratings) as avg_r');
        }
        else{
            $this->db->select('*');
        }

        if(!empty($limit)){
            if($start !== 0){
                $start = $limit * ($start - 1);
            }
            $this->db->limit($limit, $start);
        }
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_reviews.reviewer_id'); 
        if(!empty($profile_id)){
            $this->db->where('tbl_reviews.user_id ',$userProfile[0]['user_id']);
        }

        if(!empty($user_id)){
            $this->db->where('tbl_reviews.reviewer_id ',$user_id);
        }
        $this->db->where('tbl_reviews.status ','1');
        $query = $this->db->get('tbl_reviews');

        if(!empty($count)){
            return $query->num_rows();
        }
        return $query->result_array();
    }

    /*Get Offer*/
    public function _get_offer($bid_id,$column='owner_id'){
        $this->db->select('*,DATEDIFF(CURRENT_DATE(), tbl_offers.date) AS nfd,(tbl_offers.date) as bid_date,(tbl_offers.offer_amount) as bid_amount,(tbl_offers.customer_id) AS bidder_id,(tbl_offers.customer_id) AS bidder_id' );
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_offers.'.$column);
        $this->db->where('tbl_offers.id',$bid_id);   
        $query = $this->db->get('tbl_offers');
        $dataArr    = $query->result_array();

        if(!empty($dataArr)){
            $i=0;
            foreach ($dataArr as $key) {
                $dataArr[$i]['ago']                         = $this->CommonOperationsHandler->time_elapsed_string($key['bid_date']);
                $dataArr[$i]['ratings']                     = number_format($this->get_reviews($key[$column],"","","","",'avg')[0]['avg_r'],1);
                $reservedPrice                              = $this->database->_get_single_data('tbl_listings',array('id'=>$key['listing_id'],'status'=>1),'website_reserveprice');
                if($key['bid_amount'] > $reservedPrice){
                    $dataArr[$i]['reserve']                 = 1;
                }
                else {
                    $dataArr[$i]['reserve']                 = 0;   
                }

                $i++;
            }
        }
        return ($dataArr);
    }

    /*Get Table Values Offers*/
    public function _userwise_offers($userid,$group_by=""){
        $this->db->select('*,COUNT(tbl_offers.id) as NOF,MAX(tbl_offers.offer_amount) as maxAmount,(tbl_listings.id) as listing_id,(tbl_listings.status) as listing_status');
        $this->db->join('tbl_offers', 'tbl_listings.id = tbl_offers.listing_id'); 
        $this->db->where('tbl_offers.customer_id ',$userid);
        if(!empty($group_by)){
            $this->db->group_by("tbl_listings.id");
            $this->db->order_by("tbl_offers.date");
        }
        $query = $this->db->get('tbl_listings');
        $dataArr = $query->result_array();

        if(!empty($dataArr)){
            $i=0;
            foreach ($dataArr as $key) {
                $dataArr[$i]['ago'] = $this->CommonOperationsHandler->time_elapsed_string($key['date']);;
                $i++;
            }
        }
        return $dataArr;
    }

    /*Get Table Values Bids*/
    public function _userwise_bids($userid,$group_by=""){
        $this->db->select('*,COUNT(tbl_bids.id) as NOF,MAX(tbl_bids.bid_amount) as maxAmount,(tbl_listings.id) as listing_id,(tbl_listings.status) as listing_status');
        $this->db->join('tbl_bids', 'tbl_listings.id = tbl_bids.listing_id'); 
        $this->db->where('tbl_bids.bidder_id ',$userid);
        if(!empty($group_by)){
            $this->db->group_by("tbl_bids.id");
            $this->db->order_by("tbl_bids.date");
        }
        $query = $this->db->get('tbl_listings');
        $dataArr = $query->result_array();

        if(!empty($dataArr)){
            $i=0;
            foreach ($dataArr as $key) {
                $dataArr[$i]['ago'] = $this->CommonOperationsHandler->time_elapsed_string($key['date']);;
                $i++;
            }
        }
        return $dataArr;
    }

    /*Get Unapproved Bidders*/
    public function _get_bidders($listing_id,$status='0'){
        $this->db->select('*,DATEDIFF(CURRENT_DATE(), tbl_bids.date) AS nfd,(tbl_bids.date) as bid_date');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_bids.bidder_id');
        $this->db->where('tbl_bids.listing_id',$listing_id);
        $this->db->where('tbl_bids.bid_status',$status);
        $this->db->group_by('tbl_bids.bidder_id');
        $query = $this->db->get('tbl_bids');
        $dataArr    = $query->result_array();

        if(!empty($dataArr)){
            $i=0;
            foreach ($dataArr as $key) {
                $dataArr[$i]['ago']         = $this->CommonOperationsHandler->time_elapsed_string($key['bid_date']);
                $dataArr[$i]['ratings']     = number_format($this->get_reviews($key['bidder_id'],"","","","",'avg')[0]['avg_r'],1);
                $i++;
            }
        }
        return $dataArr;
    }

    /*Check Pending Bids*/
    public function _check_user_has_pending_bid($status='0'){
        $this->db->where('listing_id',$this->input->post('bid_listing_id'));
        $this->db->where('listing_type',$this->input->post('bid_listing_type'));
        $this->db->where('bid_status ',$status);
        $this->db->where('bidder_id ',$this->input->post('bid_bidder_id'));
        $query = $this->db->get('tbl_bids');
        return $query->num_rows();
    }

    /*Check Pending Bids for emails*/
    public function _check_user_has_pending_bids($id,$bidder_id,$status='0'){
        $this->db->where('listing_id',$id);
        $this->db->where('bid_status ',$status);
        $this->db->where('bidder_id ',$bidder_id);
        $query = $this->db->get('tbl_bids');
        return $query->num_rows();
    }

    /*Get the Current Price*/
    public function _get_current_price($listing_id,$listing_type='website'){
        $bids = $this->_get_all_bids($listing_id,"1",$listing_type,"","","","off");
        if(!empty($bids)){
            return max(array_column($bids, 'bid_amount'));
        }
        else
        {
            $this->db->where('id',$listing_id);
            $this->db->where('listing_type',$listing_type);
            $query = $this->db->get('tbl_listings');
            if(isset($query->result_array()[0]['website_startingprice'])){
                return $query->result_array()[0]['website_startingprice'];
            }
        }
    }

    /*Get User Wise Listing Bids*/
    public function _get_userwise_bids($listing_id,$user_id,$group=''){
        $settingsData = $this->getSettingsData();
        $this->db->select('*,(tbl_bids.id) as bid_id , (tbl_listings.date) as listing_date,(tbl_listings.status) as listing_status ,tbl_listings.website_BusinessName,tbl_listings.website_tagline,(tbl_bids.listing_type) as type');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_bids.bidder_id'); 
        $this->db->join('tbl_listings', 'tbl_listings.id = tbl_bids.listing_id','left'); 

        if(!empty($listing_id)){
           $this->db->where('tbl_bids.listing_id',$listing_id);
        }

        if(!empty($user_id)){
           $this->db->where('tbl_bids.bidder_id',$user_id); 
        }
        
        if(!empty($group)){
          $this->db->group_by("tbl_bids.id");  
        }
        
        $this->db->order_by("tbl_bids.date");
        $query      = $this->db->get('tbl_bids');
        $dataArr    = $query->result_array();

        if(!empty($dataArr)){
            $i=0;
            foreach ($dataArr as $key) {
                $dataArr[$i]['ago']     = $this->CommonOperationsHandler->time_elapsed_string($key['date']);
                $dataArr[$i]['expire']  = $this->CommonOperationsHandler->time_elapsed_string(date('Y-m-d', strtotime($key['listing_date']. ' + '.$settingsData[0]['auction_period'].'days')),false,true);
                $i++;
            }
        }

        return $dataArr;
    }

    /*Get User Wise Listing Offers*/
    public function _get_userwise_offers($listing_id,$user_id,$group=''){
        $this->db->select('*,(tbl_offers.id) as offer_id');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_offers.owner_id'); 
        $this->db->join('tbl_purchases', 'tbl_purchases.plan_id = tbl_offers.listing_id','left');

        if(!empty($listing_id)){
           $this->db->where('tbl_offers.listing_id',$listing_id);
        }

        if(!empty($user_id)){
           $this->db->where('tbl_offers.customer_id',$user_id); 
        }
        
        if(!empty($group)){
          $this->db->group_by("tbl_offers.id");  
        }

        $this->db->order_by("tbl_offers.date");
        $query      = $this->db->get('tbl_offers');
        $dataArr    = $query->result_array();

        if(!empty($dataArr)){
            $i=0;
            foreach ($dataArr as $key) {
                $dataArr[$i]['ago']     = $this->CommonOperationsHandler->time_elapsed_string($key['date']);
                $dataArr[$i]['expire']  = $this->CommonOperationsHandler->time_elapsed_string($key['expire_date'],false,true);
                $i++;
            }
        }
        return $dataArr;
    }

    /*Get Comments*/
    public function _get_comments($listing_id,$type='listing'){
        $this->db->select('*');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_comments.user_id'); 
        $this->db->where('tbl_comments.listing_id',$listing_id);
        $this->db->where('tbl_comments.section',$type);
        $this->db->order_by("tbl_comments.id");
        $query      = $this->db->get('tbl_comments');
        $dataArr    = $query->result_array();

        if(!empty($dataArr)){
            $i=0;
            foreach ($dataArr as $key) {
                $dataArr[$i]['ago'] = $this->CommonOperationsHandler->time_elapsed_string($key['date']);;
                $i++;
            }
        }
        return $dataArr;
    }

    /*Auction Ending Soons Listings*/
    public function _get_auction_ending_soon($type=''){
        $data['platforms']   =   $this->_get_row_data('tbl_platforms',array('type'=>'listing','status'=>1));
        $data['options']     =   $this->_get_row_data('tbl_platforms',array('type'=>'option','status'=>1));
        $today = date('Y-m-d H:i:s');
        $this->db->select('*,DATE_ADD(date, INTERVAL '.$this->getSettingsData()[0]['auction_period'].' DAY) AS ENDDATE ,DATEDIFF(DATE_ADD(date, INTERVAL '.$this->getSettingsData()[0]['auction_period'].' DAY),date) AS NFD,(tbl_listings.id ) as id', FALSE);
        $this->db->join('tbl_purchases', 'tbl_listings.id = tbl_purchases.plan_id');
        $this->db->group_start(); 
        $this->db->where('tbl_purchases.listing_type = tbl_listings.listing_type');
        $this->db->where('tbl_purchases.expire_date>=', $today);
        $this->db->where('tbl_purchases.purchase_date <=', $today);
        $this->db->group_end();

        $this->db->group_start(); 
        $this->db->where('status','1');
        $this->db->where('sold_status','0');
        $this->db->where('listing_option','auction');
        if(!empty($type)){
            $this->db->where('tbl_listings.listing_type',$type);
        }
        $this->db->group_end();

        $this->db->group_start(); 
        $this->db->where_in('tbl_listings.listing_type',array_column($data['platforms'], 'platform'));
        $this->db->where_in('tbl_listings.listing_option',array_column($data['options'], 'platform'));
        $this->db->group_end();

        $this->db->order_by('ENDDATE','desc');
        $this->db->group_by('tbl_listings.id');
        $query = $this->db->get('tbl_listings',10);
        $dataArr    = $query->result_array();

        if(!empty($dataArr)){
            $i=0;
            foreach ($dataArr as $key) {
                $dataArr[$i]['category']    = $this->_get_single_data('tbl_categories',array('id'=>$key['website_industry']),'c_name');
                $dataArr[$i]['username']    = $this->getUserData($key['user_id'])[0]['username'];
                $dataArr[$i]['sell_type']   = $dataArr[$i]['listing_option'];  
                $dataArr[$i]['sell_web']    = $dataArr[$i]['listing_type'];
                $i++;
            }
        }
        return $dataArr;
    }


    /*Get Specific Listings*/
    public function _get_specific_listing($listingType='sponsored',$type=""){
        $data['platforms']   =   $this->_get_row_data('tbl_platforms',array('type'=>'listing','status'=>1));
        $data['options']     =   $this->_get_row_data('tbl_platforms',array('type'=>'option','status'=>1));
        $today = date('Y-m-d H:i:s');
        $this->db->select('*,(tbl_listings.id ) as listing_id');   
        $this->db->join('tbl_listings', 'tbl_listings.id = tbl_purchases.plan_id');
        $this->db->group_start(); 
        $this->db->where('tbl_purchases.listing_type',$listingType);
        $this->db->where('tbl_purchases.expire_date>=', $today);
        $this->db->where('tbl_purchases.purchase_date <=', $today);
        $this->db->group_end();
        $this->db->where('tbl_listings.status',1);
        $this->db->where('tbl_listings.sold_status',0);
        if(!empty($type)){
            $this->db->where('tbl_listings.listing_type',$type);
        }
        $this->db->group_start(); 
        $this->db->where_in('tbl_listings.listing_type',array_column($data['platforms'], 'platform'));
        $this->db->where_in('tbl_listings.listing_option',array_column($data['options'], 'platform'));
        $this->db->group_end();
        $this->db->group_by('tbl_listings.id');
        $query = $this->db->get('tbl_purchases');
        $dataArr    = $query->result_array();

        if(!empty($dataArr)){
            $i=0;
            foreach ($dataArr as $key) {
                $dataArr[$i]['category']    = $this->_get_single_data('tbl_categories',array('id'=>$key['website_industry']),'c_name');
                $dataArr[$i]['username']    = $this->getUserData($key['user_id'])[0]['username'];
                $dataArr[$i]['sell_type']   = $dataArr[$i]['listing_option'];  
                $dataArr[$i]['sell_web']    = $dataArr[$i]['listing_type']; 

                if($dataArr[$i]['listing_type'] === 'domain'){
                    $dataArr[$i]['categoryIcon']    =   'domains.svg';
                }
                else
                {
                    $dataArr[$i]['categoryIcon']    =   'website.svg';
                }

                $i++;
            }
        }
        return $dataArr;
    }


    /*Get Sponsored Listings*/
    public function _get_sponsored_listing($listingType='sponsored',$limit=false){
        $data['platforms']   =   $this->_get_row_data('tbl_platforms',array('type'=>'listing','status'=>1));
        $data['options']     =   $this->_get_row_data('tbl_platforms',array('type'=>'option','status'=>1));
        $today = date('Y-m-d H:i:s'); 
        if($limit){
            $this->db->select('(tbl_listings.website_BusinessName ) as names');   
        }
        else
        {
            $this->db->select('*,(tbl_listings.id ) as listing_id'); 
        }
        $this->db->join('tbl_listings', 'tbl_listings.id = tbl_purchases.plan_id'); 
        $this->db->where('tbl_purchases.listing_type',$listingType);
        $this->db->where('tbl_purchases.expire_date>=', $today);
        $this->db->where('tbl_purchases.purchase_date <=', $today);
        
        $this->db->group_start(); 
        $this->db->where_in('tbl_listings.listing_type',array_column($data['platforms'], 'platform'));
        $this->db->where_in('tbl_listings.listing_option',array_column($data['options'], 'platform'));
        $this->db->group_end();
        $query = $this->db->get('tbl_purchases');
        $dataArr    = $query->result_array();
        return $dataArr;
    }

    /*Count website listings categorywise*/
    public function _count_listings_categories_wise(){
        $this->db->select('*,COUNT(tbl_listings.id) as count , (tbl_categories.id) as c_id');
        $this->db->join('tbl_listings', 'tbl_categories.id = tbl_listings.website_industry','left'); 
        $this->db->from('tbl_categories');
        $this->db->where('tbl_categories.c_level',0);
        $this->db->group_by('tbl_categories.id');
        return $this->db->get()->result_array(); 
    }

    /*Trending Classified Listings */
    public function _get_selected_listing_types($type,$sold=0,$limit=50,$listing=''){
        $data['platforms']   =   $this->_get_row_data('tbl_platforms',array('type'=>'listing','status'=>1));
        $data['options']     =   $this->_get_row_data('tbl_platforms',array('type'=>'option','status'=>1));
        $today = date('Y-m-d H:i:s');
        if(empty($sold)) {
            $this->db->select('*,(tbl_listings.id) AS id');
            $this->db->join('tbl_purchases', 'tbl_listings.id = tbl_purchases.plan_id');
            $this->db->group_start(); 
            $this->db->where('tbl_purchases.listing_type = tbl_listings.listing_type');
            $this->db->where('tbl_purchases.expire_date>=', $today);
            $this->db->where('tbl_purchases.purchase_date <=', $today);
            $this->db->group_end();

            $this->db->group_start();
            $this->db->where('tbl_listings.status','1');
            $this->db->where('tbl_listings.sold_status',$sold);
            if(!empty($listing)){
                $this->db->where($listing);
            }
            $this->db->group_end();
            $this->db->group_start(); 
            $this->db->where_in('tbl_listings.listing_type',array_column($data['platforms'], 'platform'));
            $this->db->where_in('tbl_listings.listing_option',array_column($data['options'], 'platform'));
            $this->db->group_end();
            $this->db->order_by($type,"desc");
            $this->db->group_by('tbl_listings.id');
            $query = $this->db->get('tbl_listings',$limit);
            $listingsArr = $query->result_array();

        }
        else
        {
            if($sold !== 1){
                $this->db->select('*,(tbl_listings.id) AS id');
                $this->db->join('tbl_purchases', 'tbl_listings.id = tbl_purchases.plan_id');
                $this->db->group_start(); 
                $this->db->where('tbl_purchases.listing_type = tbl_listings.listing_type');
                $this->db->where('tbl_purchases.expire_date>=', $today);
                $this->db->where('tbl_purchases.purchase_date <=', $today);
                $this->db->group_end();
            }

            $this->db->group_start();
            $this->db->where('tbl_listings.status','1');
            $this->db->where('tbl_listings.sold_status',$sold);
            if(!empty($listing)){
                $this->db->where($listing);
            }
            $this->db->group_end();

            $this->db->group_start(); 
            $this->db->where_in('tbl_listings.listing_type',array_column($data['platforms'], 'platform'));
            $this->db->where_in('tbl_listings.listing_option',array_column($data['options'], 'platform'));
            $this->db->group_end();

            $this->db->order_by($type,"desc");
            $this->db->group_by('tbl_listings.id');
            $query = $this->db->get('tbl_listings',$limit);
            $listingsArr = $query->result_array();
        }

        if(!empty($listingsArr)){
            $i = 0;
            foreach ($listingsArr as $listing) {
                if($listing['listing_type'] === 'domain'){
                    $listingsArr[$i]['category']        =   $listing['listing_type'];
                    $listingsArr[$i]['categoryIcon']    =   'domains.svg';
                }
                else
                {
                    $listingsArr[$i]['category']        =   $listing['listing_type'];
                    $listingsArr[$i]['categoryIcon']    =   'website.svg';
                }
                
                if(isset($listing['domain_id'][0]['domain'])){
                    $listingsArr[$i]['domain']          =   $this->_get_single_data('tbl_domains',array('id'=>$listing['domain_id']),'domain');
                    $listingsArr[$i]['verify']          =   $this->_get_single_data('tbl_domains',array('id'=>$listing['domain_id']),'status');
                }
                else
                {
                    $listingsArr[$i]['domain']          =   "";
                    $listingsArr[$i]['verify']          =   "";
                }

                $listingsArr[$i]['ago']                 =   $this->CommonOperationsHandler->time_elapsed_string($listing['date']);
                $listingsArr[$i]['username']            =   $this->_get_single_data('tbl_users',array('user_id'=>$listing['user_id']),'username');
                $i++;
            }
        }
        return $listingsArr;
    }

    /*View Counter Listings/ Blog */
    public function _views_counter($listing_id,$table='tbl_listings'){
        $this->db->set('views', 'views + 1',FALSE); 
        $this->db->where('id', $listing_id); 
        $this->db->update($table); 
    }

    /*User TOtal Earnings Calculation*/
    public function _user_total_earnings($user_id,$inv_type=1){
        $total =0; $earnings =0; $refunds =0;
        $ignore = array(7,3);
        $this->db->select('*, SUM(withdraw_amount) AS earnings');
        $this->db->where('paid_to',$user_id);
        $this->db->where_not_in('status',$ignore);
        $this->db->where('invoice_type',$inv_type);
        $this->db->group_by("paid_to");
        $query = $this->db->get('tbl_invoices');
        if(isset($query->result_array()[0]['earnings'])){
            $earnings = $query->result_array()[0]['earnings'];
        }

        $refunds    = $this->_user_refunds($user_id);
        $debits     = $this->_user_debits($user_id);
        $total      = ( $earnings + $refunds ) - $debits;
        return $total;
    }

    /*User Total Debits Calculation*/
    public function _user_debits($user_id,$inv_type=0){
        $this->db->select('*, SUM(withdraw_amount + success_fee + processing_fee) AS debits');
        $this->db->where('paid_to',$user_id);
        $this->db->where('status',1);
        $this->db->where('invoice_type',$inv_type);
        $this->db->group_by("paid_to");
        $query = $this->db->get('tbl_invoices');
        if(isset($query->result_array()[0]['debits'])){
            return $query->result_array()[0]['debits'];
        }
        return 0;
    }

    /*User Cleared Funds*/
    public function _user_cleared_earnings($user_id,$inv_type=1){
        $total =0; $earnings =0; $refunds =0;
        $this->db->select('*, SUM(withdraw_amount) AS earnings');
        $this->db->where('paid_to',$user_id);
        $this->db->where('status',4);
        $this->db->where('invoice_type',$inv_type);
        $this->db->group_by("paid_to");
        $query = $this->db->get('tbl_invoices');
        if(isset($query->result_array()[0]['earnings'])){
            $earnings = $query->result_array()[0]['earnings'];
        }

        $refunds    = $this->_user_refunds($user_id);
        $debits     = $this->_user_debits($user_id);
        $total      = ( $earnings + $refunds ) - $debits;
        return $total;
    }

    /*Pending earnings to be cleared */
    public function _user_pending_earnings($user_id,$inv_type=1){
        $ignore = array(4,7,3,6);
        $this->db->select('*, SUM(withdraw_amount) AS earnings');
        $this->db->where('paid_to',$user_id);
        $this->db->where_not_in('status',$ignore);
        $this->db->where('invoice_type',$inv_type);
        $this->db->group_by("paid_to");
        $query = $this->db->get('tbl_invoices');
        if(isset($query->result_array()[0]['earnings'])){
            return $query->result_array()[0]['earnings'];
        }
        return 0;
    }

    /*Pending earnings to be cleared */
    public function _user_refunds($user_id,$inv_type=1){
        $refunds = 0;
        $this->db->select('*, SUM(withdraw_amount + success_fee) AS refunds');
        $this->db->where('paid_by',$user_id);
        $this->db->where('status',3);
        $this->db->where('invoice_type',$inv_type);
        $this->db->group_by("paid_by");
        $query = $this->db->get('tbl_invoices');
        if(isset($query->result_array()[0]['refunds'])){
            $refunds =  $query->result_array()[0]['refunds'];
        }
        return $refunds;
    }

    /*Available to withdraw funds*/
    public function _user_availableto_withdraw($user_id,$inv_type=1){
        $available = 0; $total =0; $earnings =0; $refunds =0;
        $this->db->select('*, SUM(withdraw_amount) AS earnings');
        $this->db->where('paid_to',$user_id);
        $this->db->where('status',4);
        $this->db->where('invoice_type',$inv_type);
        $this->db->group_by("paid_to");
        $query = $this->db->get('tbl_invoices');

        if(isset($query->result_array()[0]['earnings'])){
            $earnings = $query->result_array()[0]['earnings'];
        }

        $refunds    = $this->_user_refunds($user_id);
        $debits     = $this->_user_debits($user_id);
        $total      = ( $earnings + $refunds ) - $debits;

        $balance = ($total - $this->_user_withdrawals($user_id));
        return $balance;
    }

    /*Get User Withdrawals*/
    public function _user_withdrawals($user_id){
        $this->db->select('*, SUM(amount) AS withdrawals');
        $this->db->where('user_id',$user_id);
        $this->db->group_start();
        $this->db->where('status',0);
        $this->db->or_where('status',1);
        $this->db->or_where('status',2);
        $this->db->group_end();
        $this->db->group_by("user_id");
        $query = $this->db->get('tbl_withdrawals');
        if(isset($query->result_array()[0]['withdrawals'])){
            return $query->result_array()[0]['withdrawals'];
        }
        return 0;
    }

    /*Get no of Clients ListingsWise*/
    public function numberOfClients($listing_id,$type,$count="",$status){
        $this->db->where('listing_id',$listing_id);
        $this->db->where('listing_type',$type);
        $this->db->where('offer_status',$status);
        $this->db->group_by('customer_id');
        $query = $this->db->get('tbl_offers');
        if(empty($count)){
            return $query->result_array();
        }
        return $query->num_rows();
    }

    /*Get Withdrawal Statements data*/
    public function _get_withdrawals($user_id,$status='',$limit=5,$start=0){
        $this->db->select('*,(tbl_withdrawal_methods.method) AS w_method ,(tbl_withdrawals.status) AS status');
        $this->db->join('tbl_withdrawal_methods', 'tbl_withdrawal_methods.id = tbl_withdrawals.method');
        $this->db->where('tbl_withdrawals.user_id',$user_id);
        if(!empty($status)){
            $this->db->where('tbl_withdrawals.status',$status);
        }

        if($start !== 0){
            $start = $limit * ($start - 1);
        }

        $this->db->limit($limit,$start);
        $query = $this->db->get('tbl_withdrawals');
        return $query->result_array();
    }

    /*Load History Records*/
    public function _load_history($contract_id){
        $this->db->where('contract_id',$contract_id);
        $this->db->order_by('date','desc');
        $query = $this->db->get('tbl_history');
        return $query->result_array();
    }

    /*Get Selected Bid*/
    public function _get_bid($bid_id,$column='owner_id'){
        $this->db->select('*,DATEDIFF(CURRENT_DATE(), tbl_bids.date) AS nfd,(tbl_bids.date) as bid_date');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_bids.'.$column);
        $this->db->where('tbl_bids.id',$bid_id);   
        $query = $this->db->get('tbl_bids');
        $dataArr    = $query->result_array();

        if(!empty($dataArr)){
            $i=0;
            foreach ($dataArr as $key) {
                $dataArr[$i]['ago']                         = $this->CommonOperationsHandler->time_elapsed_string($key['bid_date']);
                $dataArr[$i]['ratings']                     = number_format($this->get_reviews($key[$column],"","","","",'avg')[0]['avg_r'],1);
                $reservedPrice                              = $this->_get_single_data('tbl_listings',array('id'=>$key['listing_id'],'status'=>1),'website_reserveprice');
                if($key['bid_amount'] > $reservedPrice){
                    $dataArr[$i]['reserve']                 = 1;
                }
                else {
                    $dataArr[$i]['reserve']                 = 0;   
                }

                $i++;
            }
        }
        return ($dataArr);
    }

    /*Get Selected Contarct*/
    public function _get_contract($id){
        if($this->_check_user($id,'customer_id') === $this->session->userdata('user_id')){
            $this->db->join('tbl_users', 'tbl_opens.owner_id = tbl_users.user_id'); 
            $this->db->where('tbl_opens.customer_id',$this->session->userdata('user_id'));
        }
        else{
            $this->db->join('tbl_users', 'tbl_opens.customer_id = tbl_users.user_id'); 
            $this->db->where('tbl_opens.owner_id',$this->session->userdata('user_id'));
        }
        $this->db->select('*,DATE(tbl_opens.delivery_time) as dateonly,TIME(tbl_opens.delivery_time) as timeonly');
        $this->db->where('tbl_opens.id',$id);
        $this->db->or_where('tbl_opens.contract_id',$id);
        $query = $this->db->get('tbl_opens');
        return $query->result_array();
    }

    /*Check user var*/
    public function _check_user($id,$column){
        $this->db->where('id',$id);
        $this->db->or_where('contract_id',$id);
        $query = $this->db->get('tbl_opens');
        if(!empty($query->result_array()[0][$column])){
            return $query->result_array()[0][$column];
        }
        return;
    }

    /*Get Invoices userwise*/
    public function _get_invoices($owner=true){
        if($owner){
             $this->db->where('paid_to',$this->session->userdata('user_id'));
        }
        else
        {
            $this->db->or_where('paid_by',$this->session->userdata('user_id'));
        }
        $query = $this->db->get('tbl_invoices');
        return $query->result_array();
    }

    /*Discount Coupons*/
    public function discount_coupons(){
        $coupon_code    = $this->input->post('code');
        $purchases      = $this->input->post('purchases');
        $today          = date('Y-m-d');

        $query =  $this->db->query('SELECT * FROM tbl_coupons WHERE discount_code = "'. $this->db->escape($coupon_code). '" AND valid_from <= "'.$this->db->escape($today).'"
        AND valid_till >= "'.$this->db->escape($today).'"');
        $discount_couponArr = $query->result_array();

        if(!empty($discount_couponArr)){
            if(isset($discount_couponArr[0]['valid_listings']) && !empty($discount_couponArr[0]['valid_listings'])){
                $validListingsArr    = json_decode($discount_couponArr[0]['valid_listings']);

                if(!empty($validListingsArr)){
                    $purchases = array_column($purchases, 'id');
                    if(count(array_diff($validListingsArr,$purchases)) === 0){
                        exit(json_encode(array('discountType'=>$discount_couponArr[0]['discount_type'],'discount'=>$discount_couponArr[0]['amount'])));
                    }
                    exit();
                }
                exit();
            }
            exit();
        }
        exit();
    }

    /*search related operations*/
    public function _search_table($data,$limit,$start,$sort,$arr='',$count=false){
        $platforms   =   $this->_get_row_data('tbl_platforms',array('type'=>'listing','status'=>1));
        $options     =   $this->_get_row_data('tbl_platforms',array('type'=>'option','status'=>1));
        $today          =   date('Y-m-d H:i:s');
        $or_conditions  =   "";
        $searchterm     =   "";
        $listing_type   =   "";

        $this->db->select('*,(tbl_listings.id) AS id');
        if(!empty($arr)){
            if(!empty($arr['business_registeredCountry'])){
                $data['tbl_listings.business_registeredCountry'] = $arr['business_registeredCountry'];
            }

            if(!empty($arr['category'])){
                $data['tbl_listings.website_industry'] = $arr['category'];
            }

            if(!empty($arr['extension'])){
                $data['tbl_listings.extension'] = $arr['extension'];
            }

            if(!empty($arr['searchterm'])){
                $searchterm     = $arr['searchterm'];
            }

            if(!empty($arr['or_conditions'])){
                $or_conditions  = $arr['or_conditions'];
            }

            if(in_array('auction',array_column($options,'platform')) && in_array('classified',array_column($options,'platform'))){
                if(!empty($arr['listing_option'])){
                    $data['tbl_listings.listing_option'] =  $arr['listing_option'];
                }
            }
        }

        $this->db->join('tbl_purchases', 'tbl_listings.id = tbl_purchases.plan_id');
        $this->db->group_start(); 
        $this->db->where('tbl_purchases.listing_type = tbl_listings.listing_type');
        $this->db->where_in('tbl_listings.listing_type',array_column($platforms, 'platform'));
        $this->db->where('tbl_purchases.expire_date>=', $today);
        $this->db->where('tbl_purchases.purchase_date <=', $today);
        $this->db->group_end();
        
        if(!empty($data)){
            if(!empty($or_conditions)){
                $this->db->group_start();
                $this->db->where($data);
                $this->db->or_where($or_conditions);
                $this->db->group_end();
                if(!in_array('auction',array_column($options,'platform')) || !in_array('classified',array_column($options,'platform'))){
                    $this->db->where_in('tbl_listings.listing_option',array_column($options, 'platform'));
                }
                $this->db->where_in('tbl_listings.listing_type',array_column($platforms, 'platform'));
            }
            else
            {
                $this->db->where($data);
                if(!in_array('auction',array_column($options,'platform')) || !in_array('classified',array_column($options,'platform'))){
                    $this->db->where_in('tbl_listings.listing_option',array_column($options, 'platform'));
                }
                $this->db->where_in('tbl_listings.listing_type',array_column($platforms, 'platform'));
            }
        }

        if(!empty($searchterm)){
            $this->db->group_start();
            $this->db->like('tbl_listings.website_BusinessName',$searchterm);
            $this->db->or_like('tbl_listings.website_tagline',$searchterm);
            $this->db->or_like('tbl_listings.website_metadescription',$searchterm);
            $this->db->or_like('tbl_listings.description',$searchterm);
            $this->db->group_end();
        }

        if(!empty($arr['min']) && !empty($arr['max'])){
            $this->db->where('tbl_listings.website_buynowprice BETWEEN '.$arr['min'].' AND '.$arr['max']);
        }
        
        if($count){
            $this->db->distinct();
            $query      = $this->db->get('tbl_listings');
            return $query->num_rows();
        }

        if(!empty($limit)){
            if($start !== 0){
                $start = $limit * ($start - 1);
            }
            $this->db->limit($limit, $start);
        }

        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_listings.user_id');
        $this->db->order_by($sort,'asc');
        $this->db->distinct();
        $query      = $this->db->get('tbl_listings');
        $dataArr    = $query->result_array();

        if(!empty($dataArr)){
            $i=0;
            foreach ($dataArr as $key) {
                $dataArr[$i]['category']    = $this->_get_single_data('tbl_categories',array('id'=>$key['website_industry']),'c_name');
                $dataArr[$i]['sponsored']   = $this->_get_single_data('tbl_purchases',array('plan_id'=>$key['id'],'listing_type'=>'sponsored','tbl_purchases.expire_date>='=>$today,'tbl_purchases.purchase_date <='=>$today),'expire_date');
                $dataArr[$i]['username']    = $this->getUserData($key['user_id'])[0]['username'];
                $dataArr[$i]['ago']         = $this->CommonOperationsHandler->time_elapsed_string($key['date']);
                $dataArr[$i]['sell_type']   = $dataArr[$i]['listing_option'];  
                $dataArr[$i]['sell_web']    = $dataArr[$i]['listing_type']; 

                if($dataArr[$i]['listing_type'] === 'domain'){
                    $dataArr[$i]['categoryIcon']    =   'domains.svg';
                }
                else{
                    $dataArr[$i]['categoryIcon']    =   'website.svg';
                }

                $i++;
            }
        }
        return $dataArr;
    }

    /*fetch blog results*/
    public function _fetch_blog_posts($limit,$start,$count=false,$sort='date'){
        if($count){
            $this->db->where('status',1);
            $query      = $this->db->get('tbl_blog');
            return $query->num_rows();
        }

        $this->db->where('status',1);
        if(!empty($limit)){
            if($start !== 0){
                $start = $limit * ($start - 1);
            }
            $this->db->limit($limit, $start);
        }

        $this->db->order_by($sort,'asc');
        $this->db->distinct();
        $query      = $this->db->get('tbl_blog');
        return $query->result_array();
    }

    /*featch most recent posts*/
    public function _fetch_most_recent($id,$type='max'){
        $query = $this->db->query("select * from tbl_blog where id=(select ".$type."(id) from tbl_blog where id >".$this->db->escape($id).")");
        return $query->result_array();
    }

    /**Get Monthlywise Earnings*/
    public function _get_monthlywisetotalearnings($year){
        
        $query = $this->db->query("SELECT Months.m AS month, COALESCE(SUM(tbl_payments.AMOUNT),0) AS total FROM ( SELECT 1 as m UNION SELECT 2 as m UNION SELECT 3 as m UNION SELECT 4 as m UNION SELECT 5 as m UNION SELECT 6 as m UNION SELECT 7 as m UNION SELECT 8 as m UNION SELECT 9 as m UNION SELECT 10 as m UNION SELECT 11 as m UNION SELECT 12 as m ) as Months LEFT JOIN tbl_payments on Months.m = MONTH(tbl_payments.TIMESTAMP) AND YEAR(tbl_payments.TIMESTAMP) = ".$this->db->escape($year)." GROUP BY Months.m");
        return $query->result_array();
    }

    /**Get UserWise Earnings*/
    public function _get_userwisemonthlyearnings($year,$userid){
        
        $query = $this->db->query("SELECT Months.m AS month, COALESCE(SUM(tbl_invoices.withdraw_amount),0) AS total FROM ( SELECT 1 as m UNION SELECT 2 as m UNION SELECT 3 as m UNION SELECT 4 as m UNION SELECT 5 as m UNION SELECT 6 as m UNION SELECT 7 as m UNION SELECT 8 as m UNION SELECT 9 as m UNION SELECT 10 as m UNION SELECT 11 as m UNION SELECT 12 as m ) as Months LEFT JOIN tbl_invoices on Months.m = MONTH(tbl_invoices.date) AND YEAR(tbl_invoices.date) = ".$this->db->escape($year)." AND tbl_invoices.paid_to =".$this->db->escape($userid)." GROUP BY Months.m");
        return $query->result_array();
    }

    /**Get Monthlywise Total Listings*/
    public function _get_monthlywisetotallistings($year){
        
        $query = $this->db->query("SELECT Months.m AS month, COALESCE(COUNT(tbl_listings.date),0) AS total FROM ( SELECT 1 as m UNION SELECT 2 as m UNION SELECT 3 as m UNION SELECT 4 as m UNION SELECT 5 as m UNION SELECT 6 as m UNION SELECT 7 as m UNION SELECT 8 as m UNION SELECT 9 as m UNION SELECT 10 as m UNION SELECT 11 as m UNION SELECT 12 as m ) as Months LEFT JOIN tbl_listings on Months.m = MONTH(tbl_listings.date) AND YEAR(tbl_listings.date) = ".$this->db->escape($year)." GROUP BY Months.m");
        return $query->result_array();
    }

    /*get auto complete records*/
    public function _markAsCompletedAuto($table=false){
        $settingsData = $this->getSettingsData();
        $this->db->select('*,DATEDIFF(NOW(),date) as diff');
        $this->db->where('DATEDIFF(NOW(),date) > '.$settingsData[0]['mark_as_completed']);
        $this->db->where_in('status',array(5,8));
        $query = $this->db->get('tbl_opens');
        if($table){
            exit(json_encode($query->result_array()));
        }
        return $query->result_array();
    }

    /*Reset Password Request*/
    public function _reset_user_password(){
        $reset_token = $this->CommonOperationsHandler->_generate_unique_tokens('tbl_users');
        $this->EmailOperationsHandler->sendPasswordResetEmail($this->input->post('reset_email'),$reset_token);
        $data = array(
        'token' => $reset_token
        );
        return $this->_update_to_table('tbl_users',$data,array('email'=>$this->input->post('reset_email')));
    }

    /*Change User Password Reset*/
    public function _reset_user_password_update(){
        $data = array(
        'password' => md5(trim($this->input->post('reset_user_password'))),
        'token' => $this->CommonOperationsHandler->_generate_unique_tokens('tbl_users')
        );

        return $this->_update_to_table('tbl_users',$data,array('email'=>$this->input->post('reset_user_email')));
    }

    /*Get Withdrawals Data*/
    public function _withdrawals_data($status){
        $this->db->select('*,(tbl_withdrawals.id) as id,(tbl_withdrawal_methods.method) as methodw, (tbl_withdrawals.status) as statusw , (tbl_withdrawals.fee) as fee');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_withdrawals.user_id');
        $this->db->join('tbl_withdrawal_methods', 'tbl_withdrawals.method = tbl_withdrawal_methods.id','left');
        $this->db->where('tbl_withdrawals.status',$status);
        $this->db->order_by('tbl_withdrawals.created_date','asc');
        $query = $this->db->get('tbl_withdrawals');
        return $query->result_array();
    }

    /*Get Disputes Data*/
    public function _get_disputes_data($status,$id=''){
        $this->db->select('*,(tbl_opens.contract_id) as contract_id,(tbl_disputes.status) as status');
        $this->db->join('tbl_opens', 'tbl_opens.id = tbl_disputes.contract_id','left');
        $this->db->where('tbl_disputes.status',$status);  
    
        if(!empty($id)){
            $this->db->where('tbl_disputes.contract_id',$id);  
        }

        $this->db->order_by('tbl_disputes.id','asc');
        $query = $this->db->get('tbl_disputes');
        return $query->result_array();
    }

     /*Get Reported Data*/
    public function _get_reported_data(){
        $this->db->select('*');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_reports.reporter');
        $this->db->join('tbl_listings', 'tbl_listings.id = tbl_reports.listing_id');
        $this->db->where('tbl_reports.status',0);  
        $this->db->order_by('tbl_reports.date','asc');
        $query = $this->db->get('tbl_reports');
        return $query->result_array();
    }

    /*Get Recent Contarct*/
    public function _get_recent_contract($userid=false,$closed=true,$limit=true){
        
        if($userid){
            $this->db->group_start();
            $this->db->where('tbl_opens.customer_id',$this->session->userdata('user_id'));
            $this->db->or_where('tbl_opens.owner_id',$this->session->userdata('user_id'));
            $this->db->group_end();
        }

        if($closed){
            $this->db->group_start();
            $this->db->where_in('tbl_opens.status',array(4,7));
            $this->db->group_end();
        }
        else
        {
            $this->db->group_start();
            $ignore = array(1,2,3,5,6,8,9);
            $this->db->where_in('status', $ignore);
            $this->db->group_end();
        }

        if($limit){
            $this->db->order_by('tbl_opens.date');
            $query  = $this->db->get('tbl_opens',10);
        }
        else
        {
            $query  = $this->db->get('tbl_opens');
        }
       
        $dataArr   = $query->result_array();

        if(!empty($dataArr)){
            $i=0;
            foreach ($dataArr as $key) {
                $dataArr[$i]['customer']    = $this->getUserData($key['customer_id'])[0]['username'];
                $dataArr[$i]['owner']       = $this->getUserData($key['owner_id'])[0]['username']; 
                $i++;
            }
        }
        return $dataArr;
    }

    /*Get All Auction Data*/
    public function _get_auction_data($condition,$limit,$ending=false,$count=false,$start){
        $data['platforms']   =   $this->_get_row_data('tbl_platforms',array('type'=>'listing','status'=>1));
        $data['options']     =   $this->_get_row_data('tbl_platforms',array('type'=>'option','status'=>1));
        $today = date('Y-m-d H:i:s');
        if($ending){
            $this->db->select('*,(tbl_listings.id) AS id,DATE_ADD(date, INTERVAL '.$this->getSettingsData()[0]['auction_period'].' DAY) AS ENDDATE ,DATEDIFF(DATE_ADD(date, INTERVAL '.$this->getSettingsData()[0]['auction_period'].' DAY),date) AS NFD', FALSE);
            $this->db->order_by('ENDDATE','asc');
        }
        else
        {
            $this->db->select('*,(tbl_listings.id) AS id');
            $this->db->order_by('tbl_listings.date','desc');
        }

        $this->db->join('tbl_purchases', 'tbl_listings.id = tbl_purchases.plan_id');
        $this->db->group_start(); 
        $this->db->where('tbl_purchases.listing_type = tbl_listings.listing_type');
        $this->db->where('tbl_purchases.expire_date>=', $today);
        $this->db->where('tbl_purchases.purchase_date <=', $today);
        $this->db->group_end();

        $this->db->group_start();
        $this->db->where($condition);
        $this->db->where_not_in('tbl_listings.status',array(0,6));
        $this->db->group_end();

        $this->db->group_start(); 
        $this->db->where_in('tbl_listings.listing_type',array_column($data['platforms'], 'platform'));
        $this->db->where_in('tbl_listings.listing_option',array_column($data['options'], 'platform'));
        $this->db->group_end();

        $this->db->group_by('tbl_listings.id');
        
        if($count){
            $query      = $this->db->get('tbl_listings');
            return $query->num_rows();
        }

        if(!empty($limit)){
            if($start !== 0){
                $start = $limit * ($start - 1);
            }
            $this->db->limit($limit, $start);
        }

        $query = $this->db->get('tbl_listings');
        $userListings = $query->result_array();
        
        if(!empty($userListings)){
            $i=0;
            foreach ($userListings as $listing) {
            $userListings[$i]['listingType']                = $listing['listing_type'];
            {
                $userListings[$i]['totalBids']              = $this->numberOfBids($listing['id'],$listing['listing_type'],'1',1);
                $userListings[$i]['totalBidders']           = $this->numberOfBidders($listing['id'],$listing['listing_type'],'1',0);
                $userListings[$i]['totalBidValue']          = array_sum(array_column($this->numberOfBids($listing['id'],$listing['listing_type'],'',1),'bid_amount'));
                $endingArr                                  = $this->common->DateDiffCalculate($this->_get_auction_ending_date($listing['id'],'tbl_listings')[0]['ENDDATE']);
                $userListings[$i]['endingdays']             = $endingArr['days'];
                $userListings[$i]['endinghours']            = $endingArr['hours'];
                $userListings[$i]['highestbid']             = 0;
                $userListings[$i]['highestbidder']          ='n/a';
                $userListings[$i]['averageBid']             = 0;
                $userListings[$i]['reservedprice']          = $this->_get_single_data('tbl_listings',array('id'=>$listing['id']),'website_reserveprice');
                $userListings[$i]['auctionstatus']          = 'invalid';
                if ($endingArr['days'] >= 0 && $endingArr['hours'] >= 0 ) {
                    $userListings[$i]['auctionstatus']      =   'valid';
                }

                if(isset($this->_get_highest_bid_details('1',$listing['id'],$listing['listing_type'])[0]['bid_amount'])){
                    $userListings[$i]['highestbidrow']         = $this->_get_highest_bid_details('1',$listing['id'],$listing['listing_type'])[0]['bid_amount'];
                    if($userListings[$i]['highestbidrow'] > 0){
                        $userListings[$i]['highestbid']        = $this->common->ConvertToMillions($userListings[$i]['highestbidrow']);
                    }
                    else
                    {
                        $userListings[$i]['highestbid']        = $listing['website_startingprice'];
                    }
                    $userListings[$i]['highestbidder']         = $this->getUserData($this->_get_highest_bid_details('1',$listing['id'],$listing['listing_type'])[0]['bidder_id'])[0]['username'];  
                }
            }
                $i++; 
            }
           return $userListings;
        }
        return;
    }


    /*Get All Offers Data*/
    public function _get_offers_data($condition,$limit,$count=false,$start){
        $data['platforms']   =   $this->_get_row_data('tbl_platforms',array('type'=>'listing','status'=>1));
        $data['options']     =   $this->_get_row_data('tbl_platforms',array('type'=>'option','status'=>1));
        $today = date('Y-m-d H:i:s');
        $this->db->select('*,(tbl_listings.id) AS id');   
        $this->db->join('tbl_purchases', 'tbl_listings.id = tbl_purchases.plan_id');
        $this->db->group_start(); 
        $this->db->where('tbl_purchases.listing_type = tbl_listings.listing_type');
        $this->db->where('tbl_purchases.expire_date>=', $today);
        $this->db->where('tbl_purchases.purchase_date <=', $today);
        $this->db->group_end();

        $this->db->group_start(); 
        $this->db->where($condition);
        $this->db->where_not_in('tbl_listings.status',array(0,6));
        $this->db->group_end();

        $this->db->group_start(); 
        $this->db->where_in('tbl_listings.listing_type',array_column($data['platforms'], 'platform'));
        $this->db->where_in('tbl_listings.listing_option',array_column($data['options'], 'platform'));
        $this->db->group_end();

        $this->db->group_by('tbl_listings.id');

        if($count){
            $query      = $this->db->get('tbl_listings');
            return $query->num_rows();
        }

        if(!empty($limit)){
            if($start !== 0){
                $start = $limit * ($start - 1);
            }
            $this->db->limit($limit, $start);
        }

        $this->db->order_by('tbl_listings.date','desc');
        $query = $this->db->get('tbl_listings');
        $userListings = $query->result_array();
        
        if(!empty($userListings)){
            $i=0;
            foreach ($userListings as $listing) {
                $userListings[$i]['listingType']            = $listing['listing_type'];
                $userListings[$i]['totalOffers']            = $this->numberOfOffers($listing['id'],$listing['listing_type'],'1','');
                $userListings[$i]['totalClients']           = $this->numberOfClients($listing['id'],$listing['listing_type'],'1',0);
                $userListings[$i]['totalOfferValue']        = array_sum(array_column($this->numberOfOffers($listing['id'],$listing['listing_type'],'',1),'offer_amount'));
                $userListings[$i]['ago']                    = $this->CommonOperationsHandler->time_elapsed_string($listing['date']);
                $userListings[$i]['highestOffer']           = 0;
                $userListings[$i]['highestClient']          ='n/a';
                $userListings[$i]['averageOffer']           = 0;
                $userListings[$i]['minimumOffer']           = $this->_get_single_data('tbl_listings',array('id'=>$listing['id']),'website_minimumoffer');

                if(isset($this->_get_highest_offer_details('0',$listing['id'],$listing['listing_type'])[0]['offer_amount'])){
                    $userListings[$i]['highestbidrow']      = $this->_get_highest_offer_details('0',$listing['id'],$listing['listing_type'])[0]['offer_amount'];
                    if($userListings[$i]['highestbidrow'] > 0){
                        $userListings[$i]['highestbid']     = $this->common->ConvertToMillions($userListings[$i]['highestbidrow']);
                    }
                    else
                    {
                        $userListings[$i]['highestbid']     = $listing['website_startingprice'];
                    }
                    $userListings[$i]['highestbidder']      = $this->getUserData($this->_get_highest_offer_details('0',$listing['id'],$listing['listing_type'])[0]['customer_id'])[0]['username'];  
                }
                $i++; 
            }
           return $userListings;
        }
        return;
    }

    /*Set Default Language*/
    public function _set_default_language($id){
        $this->db->where('id',$id);
        $this->db->update('tbl_languages',array('default_status'=> 1));

        $this->db->where_not_in('id',$id);
        $this->db->update('tbl_languages',array('default_status'=> 0));
    }

    /*User Activate Via Token*/
    public function activateViaToken($token){
        if($this->db->where('token', $token)->count_all_results('tbl_users') > 0)
        {
            $this->db->where('token',$token);
            return $this->db->update('tbl_users',array('user_status'=>2));
        }
        return;
    }

    /*Get List Of Bidders Below the current bid*/
    public function _get_lower_bidders($id,$highest,$exclude){
        $this->db->select('*,MAX(bid_amount) as bid_amount');
        $this->db->group_start();
        $this->db->where('bid_amount < ',$highest);
        $this->db->where('listing_id',$id);
        $this->db->where('bid_status',1);
        $this->db->where_not_in('bidder_id',$exclude);
        $this->db->group_end();
        $this->db->group_by('bidder_id');
        $query = $this->db->get('tbl_bids');
        return $query->result_array();
    }

    /*Check Listing Period is expired*/
    public function _check_listing_expiry_status($id){
        if(!empty($id)){
            $today = date('Y-m-d H:i:s');
            $this->db->select('*,(tbl_listings.id) AS id');   
            $this->db->join('tbl_purchases', 'tbl_listings.id = tbl_purchases.plan_id');
            $this->db->group_start(); 
            $this->db->where('tbl_purchases.listing_type = tbl_listings.listing_type');
            $this->db->where('tbl_purchases.expire_date>=', $today);
            $this->db->where('tbl_purchases.purchase_date <=', $today);
            $this->db->group_end();

            $this->db->group_start(); 
            $this->db->where('tbl_listings.id',$id);
            $this->db->group_end();

            $this->db->group_by('tbl_listings.id');

            $query      = $this->db->get('tbl_listings');
            if($query->num_rows() > 0){
                return true;
            }
        }
        return false;
    }

    /*plugin status changer*/
    public function _plugin_status_changer($id,$status){
        $currentdata = $this->_get_row_data('tbl_platforms',array('id'=>$id));
        if(!empty($currentdata)){
            $this->db->group_start();
            $this->db->where('type',$currentdata[0]['type']);
            $this->db->where('status',0);
            $this->db->where_not_in('id',$id);
            $this->db->group_end();           
            $this->db->update('tbl_platforms', array('status' => 1));
        }
        return $this->_update_to_table('tbl_platforms',array('status' => $status),array('id' => $id));
    }
}