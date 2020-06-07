/*---------------------------------------------------------
jQuery Required for Slippa Script by Onlinetoolhub
Project:    Slippa - Domain & Website Marketplace -  V 1.0
Version:    V 1.0
Last change:    20.04.2020
Assigned to:    Onlinetoolhub
----------------------------------------------------------*/

/***DATA TABLES ***/


/*--------------------------------------------------*/
/*  Pages Datatable Functions
/*--------------------------------------------------*/
var baseLoc =window.location.pathname.split("/").pop();

function loadPageData(){
    var csrfName    = $('.txt_csrfname').attr('name');
    var csrfHash    = $('.txt_csrfname').val();
    var table = $('#tbl_pageData').DataTable( {
    destroy:true,
    "ajax": {
    "type" : "GET",
    "url" : baseUrl+'common/get_table_data/tbl_pages',
    "data": {[csrfName]: csrfHash},
    "success": function (data,json) {
        $('.txt_csrfname').val(data.token);
        getPageData(data.response);
    }}
    });
}


/*--------------------------------------------------*/
/*  Pages Control
/*--------------------------------------------------*/

function getPageData(data){
    var table = $('#tbl_pageData').DataTable( {
    destroy: true,
    data : data,
    "columns": [
    { "data": 'page_id' },
    { "data": 'txt_page_title' },
    { "data": 'txt_page_meta_description' },
    {
        "data": null,
        "className": 'center',
        "defaultContent":''
    },
    {
        "data": null,
        "className": 'center',
        "defaultContent": '<a href="" class="activeClick"><i class="fa fa-ban" aria-hidden="true"></a>'
    },
    {
        "data": null,
        "className": 'center',
        "defaultContent": '<a href="" class="editLink"><i title="edit" class="fa fa-pencil-square-o" aria-hidden="true"></a>'
    },
    {
        "data": null,
        "className": 'center',
        "defaultContent": '<a href="" class="deleteLink"><i title="delete" class="fa fa-trash" aria-hidden="true"></a>'
    }
    ],
        "order": [[1, 'asc']],
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        bFilter: false, bInfo: false,
        "createdRow": function( row, data, dataIndex ) {

        if(data.p_status === '1'){
            $('td', row).eq(6).html('<a><i title="delete" class="fa fa-trash" aria-hidden="true"></a>');
        }

        if(data.txt_page_title !== ''){
            $('td', row).eq(1).html((data.txt_page_title).substring(0,20));
        }

        if(data.txt_page_meta_description !== ''){
            $('td', row).eq(2).html((data.txt_page_meta_description).substring(0,35));
        }

        if (data.page_visibility_status =='1') {
            $('td', row).eq(4).html("<label class='badge badge-success inactiveClick'>Active </label>");
        }

        else if(data.page_visibility_status =='0' ) {
            $('td', row).eq(4).html("<label class='badge badge-danger activateClick'>Inactive</label>");
        }

        if(data.txt_page_url_slug){
            $('td', row).eq(3).html('<div class="input-group">'
            +'<input value="'+baseUrl+'page/'+data.txt_page_url_slug+'" type="text" class="form-control sharelinkSingle" readonly="true">'
            +'<button id="'+'copy-pageurl'+'-'+data.page_id+'" class="copy-url-button ripple-effect copy-pageurl" data-clipboard-action="copy" data-clipboard-text="'+baseUrl+'page/'+data.txt_page_url_slug+'" title="Copy to Clipboard" data-tippy-placement="top"><i class="icon-material-outline-file-copy"></i></button>'
            +'</div>');
        }

        },
        scrollCollapse: true,
        autoWidth:      true,  
        paging:         true,       
        columnDefs: [
            { "width": "180px", "targets": [3] },
            { "width": "10px", "targets": [2] },       
            { "width": "2px", "targets": [0,4,5] },
            { "width": "5px", "targets": [1] }
        ],
        } );


        $('#tbl_pageData tbody').off( 'click', '.deleteLink' ).on( 'click', '.deleteLink', function (e) {
            e.preventDefault();
            var data_row = table.row($(this).closest('tr')).data();
            var csrfName    = $('.txt_csrfname').attr('name');
            var csrfHash    = $('.txt_csrfname').val();
            if (typeof(data_row) != "undefined"){
                if (confirm('Confirm delete')) {    
                    window.location.href = '#';   
                    $.ajax({
                    url:baseUrl+'common/delete_from_table/tbl_pages/page_id/'+data_row.page_id,
                    type: 'POST', 
                    data:{[csrfName]: csrfHash},
                    dataType: 'json',
                    success:function(data){ 
                    $('.txt_csrfname').val(data.token);
                    loadPageData();
                    },
                    complete: function(){
                    },
                    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
                    });
                }
            }
        } );
    

        $('#tbl_pageData tbody').off( 'click', '.inactiveClick' ).on( 'click', '.inactiveClick', function (e) {
            e.preventDefault();
            var data_row = table.row($(this).closest('tr')).data();
            var csrfName    = $('.txt_csrfname').attr('name');
            var csrfHash    = $('.txt_csrfname').val();
            if (typeof(data_row) != "undefined"){
                if (confirm('Confirm Deactivation')) {
                                    
                    window.location.href = '#';
                                
                    $.ajax({
                    url:baseUrl+'common/update_selected_data/tbl_pages/page_visibility_status/0/page_id/'+data_row.page_id,
                    type: 'POST', 
                    data:{[csrfName]: csrfHash},
                    dataType: 'json',
                    success:function(data){
                    $('.txt_csrfname').val(data.token); 
                    loadPageData();
                    },
                    complete: function(){
                    },
                    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
                    });
                }
            }
        });

        $('#tbl_pageData tbody').off( 'click', '.activateClick' ).on( 'click', '.activateClick', function (e) {
            e.preventDefault();
            var data_row = table.row($(this).closest('tr')).data();
            var csrfName    = $('.txt_csrfname').attr('name');
            var csrfHash    = $('.txt_csrfname').val();
            if (typeof(data_row) != "undefined"){
                if (confirm('Confirm Activation')) {
                                    
                    window.location.href = '#';
                                
                    $.ajax({
                    url:baseUrl+'common/update_selected_data/tbl_pages/page_visibility_status/1/page_id/'+data_row.page_id,
                    type: 'POST', 
                    data:{[csrfName]: csrfHash},
                    dataType: 'json',
                    success:function(data){ 
                    $('.txt_csrfname').val(data.token); 
                    loadPageData();
                    },
                    complete: function(){
                    },
                    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
                    });
                }
            }
        });


        $('#tbl_pageData tbody').off( 'click', '.editLink' ).on( 'click', '.editLink', function (e) {
            e.preventDefault();
            var data_row = table.row($(this).closest('tr')).data();
            var csrfName    = $('.txt_csrfname').attr('name');
            var csrfHash    = $('.txt_csrfname').val();
            if (typeof(data_row) != "undefined"){        
                
                $.ajax({
                url:baseUrl+'common/get_selected_row/tbl_pages/page_id/'+data_row.page_id,
                type: 'POST',
                data:{[csrfName]: csrfHash},
                dataType: 'json',
                success:function(data,json){ 
                $('.txt_csrfname').val(data.token); 
                document.getElementById("txt_page_title").value = data.response[0].txt_page_title;
                document.getElementById("txt_page_id").value = data.response[0].page_id;
                document.getElementById("txt_page_meta_description").value = data.response[0].txt_page_meta_description;

                if(data.response[0].txt_page_meta_keywords !==""){
                    document.getElementById("txt_page_meta_keywords").value = JSON.parse(data.response[0].txt_page_meta_keywords);
                }
                        
                document.getElementById("txt_page_url_slug").value = data.response[0].txt_page_url_slug;
                $('#txt_page_description').summernote('destroy');
                $('#txt_page_description').val(data.response[0].txt_page_description).summernote();
    
                dataArr = data.response[0].page_visibility_group;
                if(dataArr.length > 0){
                    $('#page_visibility_group').val(dataArr);
                    $('#page_visibility_group').trigger('change');
                }

                $('#page_visibility_status').val(data.response[0].page_visibility_status);
                $(this).closest('form').find("input[type=text], textarea").val("");
                loadPageData();
                },

                complete: function(){
                },
                error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
                });
            }
        });
}


/*--------------------------------------------------*/
/*  Blog Datatable Functions
/*--------------------------------------------------*/

function loadBlogData(){
    var csrfName    = $('.txt_csrfname').attr('name');
    var csrfHash    = $('.txt_csrfname').val();
    var table = $('#tbl_blogData').DataTable( {
    destroy:true,
    "ajax": {
    "type" : "GET",
    "url" : baseUrl+'common/get_table_data/tbl_blog',
    "data": {[csrfName]: csrfHash},
    "success": function (data,json) {
        $('.txt_csrfname').val(data.token); 
        getBlogData(data.response);
    }}
    });
}

/*--------------------------------------------------*/
/*  Blog Control
/*--------------------------------------------------*/

function getBlogData(data){
    var table = $('#tbl_blogData').DataTable( {
    destroy: true,
    data : data,
    "columns": [
    { "data": 'id' },
    { "data": 'title' },
    { "data": 'metadescription' },
    {
        "data": null,
        "className": 'center',
        "defaultContent":''
    },
    {
        "data": null,
        "className": 'center',
        "defaultContent": '<a href="" class="activeClick"><i class="fa fa-ban" aria-hidden="true"></a>'
    },
    {
        "data": null,
        "className": 'center',
        "defaultContent": '<a href="" class="editLink"><i title="edit" class="fa fa-pencil-square-o" aria-hidden="true"></a>'
    },
    {
        "data": null,
        "className": 'center',
        "defaultContent": '<a href="" class="deleteLink"><i title="delete" class="fa fa-trash" aria-hidden="true"></a>'
    }
    ],
    "order": [[1, 'asc']],
    dom: 'Bfrtip',
    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
    bFilter: false, bInfo: false,
    "createdRow": function( row, data, dataIndex ) {
        if(data.title !== ''){
            $('td', row).eq(1).html((data.title).substring(0,20));
        }

        if(data.metadescription !== ''){
            $('td', row).eq(2).html((data.metadescription).substring(0,35));
        }

        if (data.status =='1') {
            $('td', row).eq(4).html("<label class='badge badge-success inactiveClick'>Active </label>");
        }

        else if(data.status =='0' ) {
            $('td', row).eq(4).html("<label class='badge badge-danger activateClick'>Inactive</label>");
        }

        if(data.slug){
            $('td', row).eq(3).html('<div class="input-group">'
            +'<input value="'+baseUrl+'blog_post/'+data.slug+'" type="text" class="form-control sharelinkSingle" readonly="true">'
            +'<button id="'+'copy-pageurl'+'-'+data.id+'" class="copy-url-button ripple-effect copy-pageurl" data-clipboard-action="copy" data-clipboard-text="'+baseUrl+'blog_post/'+data.slug+'" title="Copy to Clipboard" data-tippy-placement="top"><i class="icon-material-outline-file-copy"></i></button>'
            +'</div>');
        }

    },
    scrollCollapse: true,
    autoWidth:      true,  
    paging:         true,       
    columnDefs: [
        { "width": "180px", "targets": [3] },
        { "width": "10px", "targets": [2] },       
        { "width": "2px", "targets": [0,4,5] },
        { "width": "5px", "targets": [1] }
    ],
    } );

    $('#tbl_blogData tbody').off( 'click', '.deleteLink' ).on( 'click', '.deleteLink', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName    = $('.txt_csrfname').attr('name');
        var csrfHash    = $('.txt_csrfname').val();
        if (typeof(data_row) != "undefined"){
            if (confirm('Confirm delete')) {
                                    
                window.location.href = '#';
                                
                $.ajax({
                url:baseUrl+'common/delete_from_table/tbl_blog/id/'+data_row.id,
                type: 'POST', 
                data:{[csrfName]: csrfHash},
                dataType: 'json',
                success:function(data){ 
                $('.txt_csrfname').val(data.token);  
                loadBlogData();
                },
                complete: function(){
                },
                error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
                });
            }
        }
    });
    
    $('#tbl_blogData tbody').off( 'click', '.inactiveClick' ).on( 'click', '.inactiveClick', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName    = $('.txt_csrfname').attr('name');
        var csrfHash    = $('.txt_csrfname').val();
        if (typeof(data_row) != "undefined"){
            if (confirm('Confirm Deactivation')) {
                                    
                window.location.href = '#';
                                
                $.ajax({
                url:baseUrl+'common/update_selected_data/tbl_blog/page_visibility_status/0/id/'+data_row.id,
                type: 'POST', 
                data:{[csrfName]: csrfHash},
                dataType: 'json',
                success:function(data){ 
                $('.txt_csrfname').val(data.token);  
                loadBlogData();
                },
                complete: function(){
                },
                error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
                });
                }
        }
    });

    $('#tbl_blogData tbody').off( 'click', '.activateClick' ).on( 'click', '.activateClick', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName    = $('.txt_csrfname').attr('name');
        var csrfHash    = $('.txt_csrfname').val();
        if (typeof(data_row) != "undefined"){
            if (confirm('Confirm Activation')) {
                                    
                window.location.href = '#';
                                
                $.ajax({
                url:baseUrl+'common/update_selected_data/tbl_blog/page_visibility_status/1/id/'+data_row.id,
                type: 'POST',
                data:{[csrfName]: csrfHash},
                dataType: 'json', 
                success:function(data){ 
                $('.txt_csrfname').val(data.token);  
                loadBlogData();
                },
                complete: function(){
                },
                error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
                });
            }
        }
    });

    $('#tbl_blogData tbody').off( 'click', '.editLink' ).on( 'click', '.editLink', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName    = $('.txt_csrfname').attr('name');
        var csrfHash    = $('.txt_csrfname').val();
        if (typeof(data_row) != "undefined"){  

            $.ajax({
            url:baseUrl+'common/get_selected_row/tbl_blog/id/'+data_row.id,
            type: 'POST',
            data:{[csrfName]: csrfHash},
            dataType: 'json', 
            success:function(data,json){ 
            $('.txt_csrfname').val(data.token);
            document.getElementById("txt_blogpost_title").value = data.response[0].title;
            document.getElementById("txt_blogpost_id").value = data.response[0].id;
            document.getElementById("txt_blogpost_meta_description").value = data.response[0].metadescription;
                            
            if(data.response[0].metakeywords !==""){
                document.getElementById("txt_blogpost_meta_keywords").value = JSON.parse(data.response[0].metakeywords);
            }

            if(data.response[0].blog_tags !==""){
                document.getElementById("txt_blogpost_tags").value = JSON.parse(data.response[0].blog_tags);
            }

            document.getElementById("txt_blogpost_url_slug").value = data.response[0].slug;
            $('#txt_blogpost_description').summernote('destroy');
            $('#txt_blogpost_description').val(data.response[0].blog_post).summernote();
            $('#blogpostvisibility_status').val(data.response[0].status);
            $('.uploadButton-input-cover').next('label').text(data.response[0].thumbnail);
            $(this).closest('form').find("input[type=text], textarea").val("");
            loadBlogData();
            },
            complete: function(){
            },
            error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
            });
        }
    });
}


/*--------------------------------------------------*/
/*  Listings Datatable Functions
/*--------------------------------------------------*/

function loadListingsData(id){
    var csrfName    = $('.txt_csrfname').attr('name');
    var csrfHash    = $('.txt_csrfname').val();
    var table = $('#tbl_ListingsData').DataTable( {
    destroy:true,
    "ajax": {
    "type" : "GET",
    "url" : baseUrl+'common/get_listing_table_data/'+id,
    "data": {[csrfName]: csrfHash},
    "success": function (data,json) {
        $('.txt_csrfname').val(data.token);  
        getListingsData(data.response);
    }}
    });
}

/*--------------------------------------------------*/
/*  Listings Control
/*--------------------------------------------------*/
function getListingsData(data){
    var table = $('#tbl_ListingsData').DataTable( {
    destroy: true,
    data : data,
    "columns": [
    { "data": 'id' },
    { "data": 'listing_type' },
    { "data": 'website_BusinessName' },
    { "data": 'listing_option' },
    {
        "data": null,
        "className": 'center',
        "defaultContent": ''
    },
    {
        "data": null,
        "className": 'center',
        "defaultContent": ''
    },
    {
        "data": null,
        "className": 'center',
        "defaultContent": '<a href="" class="inactiveClick"><i class="fa fa-ban" aria-hidden="true"></a>'
    },
    {
        "data": null,
        "className": 'center',
        "defaultContent": '<a href="" class="deleteLink"><i title="delete" class="fa fa-trash" aria-hidden="true"></a>'
    }
    ],
    "order": [[1, 'asc']],
    dom: 'Bfrtip',
    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
    bFilter: false, bInfo: false,
    "createdRow": function( row, data, dataIndex ) {
    if(data.status === '1'){
        $('td', row).eq(4).html("<label class='badge badge-success'>Active</label>");
        $('td', row).eq(6).html("<a href='' class='inactiveClick'><i class='fa fa-ban' aria-hidden='true'></a>");
    }
    else if(data.status === '2'){
        $('td', row).eq(4).html("<label class='badge badge-danger'>Suspended</label>");
        $('td', row).eq(6).html("<a href='' class='activateClick'><i class='fa fa-check' aria-hidden='true'></a>");
    }
    else if(data.status === '0'){
        $('td', row).eq(4).html("<label class='badge badge-warning'>Payment Pending</label>");
    }
    else if(data.status === '4'){
        $('td', row).eq(4).html("<label class='badge badge-dark'>Expired</label>");
    }
    else if(data.status === '5'){
        $('td', row).eq(4).html("<label class='badge badge-info'>Unverified</label>");
    }
    else if(data.status === '6'){
        $('td', row).eq(4).html("<label class='badge badge-danger'>Deleted by Seller</label>");
    }

    if(data.sold_status === '1'){
        $('td', row).eq(5).html("<label class='badge badge-success'>SOLD</label>");
    }
    else
    {
        $('td', row).eq(5).html("<label class='badge badge-warning'>AVAILABLE</label>");
    }

    },       
    });

    $('#tbl_ListingsData tbody').off( 'click', '.deleteLink' ).on( 'click', '.deleteLink', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName    = $('.txt_csrfname').attr('name');
        var csrfHash    = $('.txt_csrfname').val();
        if (typeof(data_row) != "undefined"){
            if (confirm('Confirm delete')) {
                                    
                window.location.href = '#';
                                
                $.ajax({
                url:baseUrl+'common/delete_from_table/tbl_listings/id/'+data_row.id,
                type: 'POST', 
                data:{[csrfName]: csrfHash},
                dataType: 'json', 
                success:function(data){ 
                $('.txt_csrfname').val(data.token);  
                loadListingsData('');
                },
                complete: function(){
                },
                error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
                });
            }
        }
    });

    $('#tbl_ListingsData tbody').off( 'click', '.inactiveClick' ).on( 'click', '.inactiveClick', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName    = $('.txt_csrfname').attr('name');
        var csrfHash    = $('.txt_csrfname').val();
        if (typeof(data_row) != "undefined"){
            if (confirm('Do you want to suspend this?')) {
                                    
                window.location.href = '#';
                                
                $.ajax({
                url:baseUrl+'common/update_selected_data/tbl_listings/status/2/id/'+data_row.id,
                type: 'POST', 
                data:{[csrfName]: csrfHash},
                dataType: 'json',
                success:function(data){
                $('.txt_csrfname').val(data.token);   
                loadListingsData('');
                },
                complete: function(){
                },
                error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
                });
                }
        }
    });

    $('#tbl_ListingsData tbody').off( 'click', '.activateClick' ).on( 'click', '.activateClick', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName    = $('.txt_csrfname').attr('name');
        var csrfHash    = $('.txt_csrfname').val();
        if (typeof(data_row) != "undefined"){
            if (confirm('Do you want to activate this?')) {
                                    
                window.location.href = '#';
                                
                $.ajax({
                url:baseUrl+'common/update_selected_data/tbl_listings/status/1/id/'+data_row.id,
                type: 'POST', 
                data:{[csrfName]: csrfHash},
                dataType: 'json', 
                success:function(data){
                $('.txt_csrfname').val(data.token);  
                loadListingsData('');
                },
                complete: function(){
                },
                error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
                });
            }
        }
    });
}


/*--------------------------------------------------*/
/*  Cron Jobs Loading
/*--------------------------------------------------*/

function loadCronData(){
    var csrfName    = $('.txt_csrfname').attr('name');
    var csrfHash    = $('.txt_csrfname').val();
    var table = $('#tbl_crondata').DataTable( {
    destroy:true,
    "ajax": {
    "type" : "GET",
    "url" : baseUrl+'cron/get_data',
    "data": {[csrfName]: csrfHash},
    "success": function (data,json) {
        $('.txt_csrfname').val(data.token);  
        getCronData(data.response);
    }}
    });
}


/*--------------------------------------------------*/
/*  Cron Jobs Controls
/*--------------------------------------------------*/

function getCronData(data){
    var table = $('#tbl_crondata').DataTable( {
    destroy: true,
    data : data,
    "columns": [{
        "className":  'details-control',
        "orderable":  false,
        "data":       null,
        "defaultContent": ''
    },
    { "data": 'cron_Minute' },
    { "data": 'cron_Hour' },
    { "data": 'cron_day' },
    { "data": 'cron_month' },
    { "data": 'cron_weekday' },
    { "data": 'cron_job' },
    {
        "data": null,
        "className": 'center',
        "defaultContent": '<a href="" class="deleteLink">Delete</a>'
    }
    ],
    "order": [[1, 'asc']],
    });


    $('#tbl_crondata tbody').on( 'click', '.deleteLink', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName    = $('.txt_csrfname').attr('name');
        var csrfHash    = $('.txt_csrfname').val();
        if (typeof(data_row) != "undefined"){
            $.ajax({
            url:baseUrl+'cron/deletecronDatafromDb/'+data_row.cron_job,
            type: 'POST', 
            data:{[csrfName]: csrfHash},
            dataType: 'json',
            success:function(data){ 
            $('.txt_csrfname').val(data.token);  
            loadCronData();
            },
            complete: function(){
            },
            error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
            });
        }
    });
}


/*--------------------------------------------------*/
/*  Load Categories Data
/*--------------------------------------------------*/
function loadCategoryData(){
    var csrfName    = $('.txt_csrfname').attr('name');
    var csrfHash    = $('.txt_csrfname').val();
    var table       = $('#tbl_categoriesData').DataTable( {
    destroy:true,
    "ajax": {
    "type" : "GET",
    "url" : baseUrl+'common/get_table_data/tbl_categories',
    "data": {[csrfName]: csrfHash},
    "success": function (data,json) {
        $('.txt_csrfname').val(data.token);  
        getCategoryData(data.response);
    }}
    });
}

/*--------------------------------------------------*/
/*  Load Categories Controls
/*--------------------------------------------------*/
function getCategoryData(data){
    var table = $('#tbl_categoriesData').DataTable( {
    destroy: true,
    data : data,
    "columns": [
    { "data": 'c_name' },
    { "data": 'c_description' },
    {
        "data": null,
        "className": 'center',
        "defaultContent":''
    },
    {
        "data": null,
        "className": 'center',
        "defaultContent":''
    },
    {
        "data": null,
        "className": 'center',
        "defaultContent": '<a href="" class="editLink"><i title="edit" class="fas fa-edit" aria-hidden="true"></a>'
    },
    {
        "data": null,
        "className": 'center',
        "defaultContent": '<a href="" class="deleteLink"><i title="delete" class="fa fa-trash" aria-hidden="true"></a>'
    }
    ],
    "order": [[1, 'asc']],
    dom: 'Bfrtip',
    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
    bFilter: false, bInfo: false,
    "createdRow": function( row, data, dataIndex ) {
    if(data.c_level === '0'){
        $('td', row).eq(2).html("<label class='badge badge-info'>MAIN</label>");
    }
    else
    {
        $('td', row).eq(2).html("<label class='badge badge-info'>SUB</label>");
    }

    if(data.c_thumb !== ''){
        $('td', row).eq(3).html("<img src='"+baseUrl+'assets/img/categories/'+data.c_thumb+"' class='img-fluid img-thumbnail'> </a>");
    }
    else
    {
        $('td', row).eq(3).html("N/A");
    }
    },
    scrollX:        true,
    scrollCollapse: true,
    autoWidth:      true,  
    paging:         true,       
    });


    $('#tbl_categoriesData tbody').off( 'click', '.deleteLink' ).on( 'click', '.deleteLink', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName    = $('.txt_csrfname').attr('name');
        var csrfHash    = $('.txt_csrfname').val();
        if (typeof(data_row) != "undefined"){
            if (confirm('Confirm delete')) {
                                    
                window.location.href = '#';
                                
                $.ajax({
                url:baseUrl+'common/delete_from_table/tbl_categories/id/'+data_row.id,
                type: 'POST', 
                data:{[csrfName]: csrfHash},
                dataType: 'json',
                success:function(data){
                $('.txt_csrfname').val(data.token);  
                loadCategoryData();
                },
                complete: function(){
                },
                error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
                });
            }
        }
    });
    

    $('#tbl_categoriesData tbody').off( 'click', '.editLink' ).on( 'click', '.editLink', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName    = $('.txt_csrfname').attr('name');
        var csrfHash    = $('.txt_csrfname').val();
        if (typeof(data_row) != "undefined"){        
            $.ajax({
            url:baseUrl+'common/get_selected_row/tbl_categories/id/'+data_row.id,
            type: 'POST',
            data:{[csrfName]: csrfHash},
            dataType: 'json',
            success:function(data,json){ 
            $('.txt_csrfname').val(data.token); 
            document.getElementById("category_name").value = data.response[0].c_name;
            document.getElementById("category_meta_description").value = data.response[0].c_description;
            document.getElementById("category_id").value = data.response[0].id;
            document.getElementById("category_url_slug").value = data.response[0].url_slug;
            $('.uploadButton-input-cover').next('label').text(data.response[0].c_thumb);
            $('#category_level').val(data.response[0].c_level);

            if(data.response[0].metakeywords !==""){
                document.getElementById("category_meta_keywords").value = JSON.parse(data.response[0].c_keywords);
            }

            $(this).closest('form').find("input[type=text], textarea").val("");
            loadCategoryData();
            },
            complete: function(){
            },
            error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
            });
        }
    });

}


/*--------------------------------------------------*/
/*  Load Listing Header Data
/*--------------------------------------------------*/
function loadListingHeaderData(){
    var csrfName    = $('.txt_csrfname').attr('name');
    var csrfHash    = $('.txt_csrfname').val();
    var table = $('#tbl_ListingsData').DataTable( {
    destroy:true,
    "ajax": {
    "type" : "GET",
    "url" : baseUrl+'common/get_table_data/tbl_listing_header',
    "data": {[csrfName]: csrfHash},
    "success": function (data,json) {
        $('.txt_csrfname').val(data.token);
        getListingHeaderData(data.response);
    }}
    });
}

/*--------------------------------------------------*/
/*  Load Listing Headers
/*--------------------------------------------------*/
function getListingHeaderData(data){
    var table = $('#tbl_ListingsData').DataTable( {
    destroy: true,
    data : data,
    "columns": [
    { "data": 'listing_name' },
    { "data": 'listing_type' },
    { "data": 'listing_price' },
    { "data": 'listing_duration' },
    {
        "data": null,
        "className": 'center',
        "defaultContent":''
    },
    {
        "data": null,
        "className": 'center',
        "defaultContent": '<a href="" class="editLink"><i title="edit" class="fas fa-edit" aria-hidden="true"></a>'
    },
    {
        "data": null,
        "className": 'center',
        "defaultContent": '<a href="" class="deleteLink"><i title="delete" class="fa fa-trash" aria-hidden="true"></a>'
    }
    ],
    "order": [[1, 'asc']],
    dom: 'Bfrtip',
    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
    bFilter: false, bInfo: false,
    "createdRow": function( row, data, dataIndex ) {
    if(data.status === '1'){
        $('td', row).eq(4).html("<label class='badge badge-success'>ON</label>");
    }
    else
    {
        $('td', row).eq(4).html("<label class='badge badge-warning'>OFF</label>");
    }
    },
    scrollX:        true,
    scrollCollapse: true,
    autoWidth:      true,  
    paging:         true,       
    });


    $('#tbl_ListingsData tbody').off( 'click', '.deleteLink' ).on( 'click', '.deleteLink', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName    = $('.txt_csrfname').attr('name');
        var csrfHash    = $('.txt_csrfname').val();
        if (typeof(data_row) != "undefined"){
            if (confirm('Confirm delete')) {
                                    
                window.location.href = '#';
                                
                $.ajax({
                url:baseUrl+'common/delete_from_table/tbl_listing_header/listing_id/'+data_row.listing_id,
                type: 'POST',
                data:{[csrfName]: csrfHash},
                dataType: 'json', 
                success:function(data){ 
                $('.txt_csrfname').val(data.token);
                loadListingHeaderData();
                },
                complete: function(){
                },
                error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
                });
            }
        }
    });
    

    $('#tbl_ListingsData tbody').off( 'click', '.editLink' ).on( 'click', '.editLink', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName    = $('.txt_csrfname').attr('name');
        var csrfHash    = $('.txt_csrfname').val();
        if (typeof(data_row) != "undefined"){        
            $.ajax({
            url:baseUrl+'common/get_selected_row/tbl_listing_header/listing_id/'+data_row.listing_id,
            type: 'POST',
            data:{[csrfName]: csrfHash},
            dataType: 'json',
            success:function(data,json){ 
            $('.txt_csrfname').val(data.token); 
            document.getElementById("listing_name").value = data.response[0].listing_name;
            document.getElementById("listing_description").value = data.response[0].listing_description;
            document.getElementById("listing_id").value = data.response[0].listing_id;
            document.getElementById("listing_price").value = data.response[0].listing_price;
            document.getElementById("listing_duration").value = data.response[0].listing_duration;
            $('.uploadButton-input-cover').next('label').text(data.response[0].listing_icon);
            $('#listing_type').val(data.response[0].listing_type);
            $('#listing_status').val(data.response[0].status);

            $(this).closest('form').find("input[type=text], textarea").val("");
            loadListingHeaderData();
            },
            complete: function(){
            },
            error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
            });
        }
    });

}


/*--------------------------------------------------*/
/* Load User data
/*--------------------------------------------------*/
function loadUserData(){
    var csrfName    = $('.txt_csrfname').attr('name');
    var csrfHash    = $('.txt_csrfname').val();
    var table       = $('#tbl_userdata').DataTable( {
    destroy:true,
    "ajax": {
    "type" : "GET",
    "url" : baseUrl+'common/get_table_data/tbl_users',
    "data": {[csrfName]: csrfHash},
    "success": function (data,json) {
        $('.txt_csrfname').val(data.token);  
        getUserControlData(data.response);
    }
    }
    });
}

/*--------------------------------------------------*/
/*  Load User Controls
/*--------------------------------------------------*/

function getUserControlData(data){
    var table = $('#tbl_userdata').DataTable( {
    destroy: true,
    data : data,
    "columns": [
    { "data": 'user_id' },
    { "data": 'username' },
    { "data": 'email' },
    { "data": 'firstname' },
    { "data": 'user_ip' },
    { "data": 'user_status' },
    {
        "data": null,
        "className": 'center',
        "defaultContent": '<a href="" class="banUserClick"><i class="fa fa-ban" aria-hidden="true"></a>'
    },
    {
        "data": null,
        "className": 'center',
        "defaultContent": '<a href="" class="activateClick"><i title="delete" class="fa fa-trash-alt" aria-hidden="true"></a>'
    }
    ],
    "order": [[1, 'asc']],
    dom: 'Bfrtip',
    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
    "createdRow": function( row, data, dataIndex ) {
    if(typeof(data.user_status) !== "undefined"){
        if (data.user_status =='1') {
            $('td', row).eq(6).html("<a href='' class='banUserClick'><i title='Ban User' class='fa fa-ban'></i></a>");
            $('td', row).eq(7).html("<a href='' class='activateClick'><i title='Activate User' class='fa fa-unlock fa-user-green'></i></a>");        
            $('td', row).eq(5).html("<label class='badge badge-info'>Inactive</label>");
        }
        else if(data.user_status =='2' ) {
            $('td', row).eq(6).html("<a href='' class='banUserClick'><i title='Ban User' class='fa fa-ban'></i></a>");
            $('td', row).eq(7).html("<a href='' class='inactiveClick'><i title='deactivate' class='fa fa-lock fa-user-green'></i></a>"); 
            $('td', row).eq(5).html("<label class='badge badge-success'>Active</label>");
        }
        else if(data.user_status =='3' ) {
            $('td', row).eq(6).html("<a href='' class='activateClick'><i title='remove ban' class='fas fa fa-check'></i></a>");
            $('td', row).eq(7).html("<a href='' class='activateClick'><i title='activate' class='fa fa-unlock fa-user-green'></i></a>"); 
            $('td', row).eq(5).html("<label class='badge badge-danger'>Banned</label>");
        }
        else if(data.user_status =='4' ) {
            $('td', row).eq(6).html("<a href='' class='banUserClick'><i title='Ban User' class='fa fa-ban'></i></a>");
            $('td', row).eq(7).html("<a href='' class='activateClick'><i title='activate' class='fa fa-unlock fa-user-green'></i></a>"); 
            $('td', row).eq(5).html("<label class='badge badge-warning'>deactivated</label>");
        }
    }
    },
    });


    $('#tbl_userdata tbody').off( 'click', '.inactiveClick' ).on( 'click', '.inactiveClick', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName    = $('.txt_csrfname').attr('name');
        var csrfHash    = $('.txt_csrfname').val();
        if (typeof(data_row) != "undefined"){
            
            if (confirm('Confirm User Deactivation')) {
                                    
                window.location.href = '#';             
                $.ajax({
                url:baseUrl+'common/update_selected_data/tbl_users/user_status/1/user_id/'+data_row.user_id,
                type: 'POST',
                data:{[csrfName]: csrfHash},
                dataType: 'json', 
                success:function(data){ 
                $('.txt_csrfname').val(data.token);    
                loadUserData();
                },
                complete: function(){
                },
                error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
                });
            }
        }
    });


    $('#tbl_userdata tbody').off( 'click', '.activateClick' ).on( 'click', '.activateClick', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName    = $('.txt_csrfname').attr('name');
        var csrfHash    = $('.txt_csrfname').val();
        if (typeof(data_row) != "undefined"){
            if (confirm('Confirm User Activation')) {              
                window.location.href = '#'; 
                $.ajax({
                url:baseUrl+'common/update_selected_data/tbl_users/user_status/2/user_id/'+data_row.user_id,
                type: 'POST',
                data:{[csrfName]: csrfHash},
                dataType: 'json', 
                success:function(data){ 
                $('.txt_csrfname').val(data.token);    
                loadUserData();
                },
                complete: function(){
                },
                error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
                });
            }
        }
    });


    $('#tbl_userdata tbody').off( 'click', '.banUserClick' ).on( 'click', '.banUserClick', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName    = $('.txt_csrfname').attr('name');
        var csrfHash    = $('.txt_csrfname').val();
        if (typeof(data_row) != "undefined"){
            if (confirm('Confirm User Ban')) {
                                  
                window.location.href = '#';            
                $.ajax({
                url:baseUrl+'common/update_selected_data/tbl_users/user_status/3/user_id/'+data_row.user_id,
                type: 'POST',
                data:{[csrfName]: csrfHash},
                dataType: 'json', 
                success:function(data){ 
                $('.txt_csrfname').val(data.token);    
                loadUserData();
                },
                complete: function(){
                },
                error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
                });
            }
        }
    });
}


/*--------------------------------------------------*/
/* Load Announcement Data
/*--------------------------------------------------*/
function loadAnnouncementData(){
    var csrfName    = $('.txt_csrfname').attr('name');
    var csrfHash    = $('.txt_csrfname').val();
    var table = $('#tbl_announcementdata').DataTable( {
    destroy:true,
    "ajax": {
    "type" : "GET",
    "url" : baseUrl+'common/get_table_data/tbl_announcement',
    "data": {[csrfName]: csrfHash},
    "success": function (data,json) {
        $('.txt_csrfname').val(data.token);
        getAnnouncementData(data.response);
    }}
    });
}


/*--------------------------------------------------*/
/*  Announcement Data Controls
/*--------------------------------------------------*/
function getAnnouncementData(data){
    var table = $('#tbl_announcementdata').DataTable( {
    destroy: true,
    data : data,
    "columns": [
    { "data": 'id' },
    { "data": 'announcement_heading' },
    { "data": 'announcement_type' },
    { "data": 'group_id' },
    { "data": 'status' },
    {
        "data": null,
        "className": 'center',
        "defaultContent": '<a href="" class="activeClick"><i class="fa fa-ban" aria-hidden="true"></a>'
    },
    {
        "data": null,
        "className": 'center',
        "defaultContent": '<a href="" class="editLink"><i title="edit" class="fa fa-pencil-square-o" aria-hidden="true"></a>'
    },
    {
        "data": null,
        "className": 'center',
        "defaultContent": '<a href="" class="deleteLink"><i title="delete" class="fa fa-trash" aria-hidden="true"></a>'
    }
    ],
    "order": [[1, 'asc']],
    dom: 'Bfrtip',
    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
    "createdRow": function( row, data, dataIndex ) {
    if (data.status =='1') {
        $('td', row).eq(5).html("<a href='' class='inactiveClick'><i title='deactivate' class='fa fa-lock fa-user-green'></i></a>");        
        $('td', row).eq(4).html("<label class='badge badge-success'>Active</label>");
    }
    else if(data.status =='0' ) {
        $('td', row).eq(5).html("<a href='' class='activateClick'><i title='activate' class='fa fa-unlock fa-user-green'></i></a>"); 
        $('td', row).eq(4).html("<label class='badge badge-danger'>Inactive</label>");
    }
    },
    });


    $('#tbl_announcementdata tbody').off( 'click', '.deleteLink' ).on( 'click', '.deleteLink', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName    = $('.txt_csrfname').attr('name');
        var csrfHash    = $('.txt_csrfname').val();
        if (typeof(data_row) != "undefined"){
            if (confirm('Confirm delete')) {
                                    
                window.location.href = '#';
                                
                $.ajax({
                url:baseUrl+'common/delete_from_table/tbl_announcement/id/'+data_row.id,
                type: 'POST', 
                data:{[csrfName]: csrfHash},
                dataType: 'json',
                success:function(data){ 
                $('.txt_csrfname').val(data.token); 
                loadAnnouncementData();
                },
                complete: function(){
                },
                error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
                });
            }
        }
    });
    

    $('#tbl_announcementdata tbody').off( 'click', '.inactiveClick' ).on( 'click', '.inactiveClick', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName    = $('.txt_csrfname').attr('name');
        var csrfHash    = $('.txt_csrfname').val();
        if (typeof(data_row) != "undefined"){
            if (confirm('Confirm Deactivation')) {
                                    
                window.location.href = '#';
                                
                $.ajax({
                url:baseUrl+'common/update_selected_data/tbl_announcement/status/0/id/'+data_row.id,
                type: 'POST', 
                data:{[csrfName]: csrfHash},
                dataType: 'json',
                success:function(data){ 
                $('.txt_csrfname').val(data.token); 
                loadAnnouncementData();
                },
                complete: function(){
                },
                error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
                });
            }
        }
    });

    $('#tbl_announcementdata tbody').off( 'click', '.activateClick' ).on( 'click', '.activateClick', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName    = $('.txt_csrfname').attr('name');
        var csrfHash    = $('.txt_csrfname').val();
        if (typeof(data_row) != "undefined"){
            if (confirm('Confirm Activation')) {
                                    
                window.location.href = '#';
                                
                $.ajax({
                url:baseUrl+'common/update_selected_data/tbl_announcement/status/1/id/'+data_row.id,
                type: 'POST', 
                data:{[csrfName]: csrfHash},
                dataType: 'json',
                success:function(data){ 
                $('.txt_csrfname').val(data.token); 
                loadAnnouncementData();
                },
                complete: function(){
                },
                error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
                });
            }
        }
    });

    $('#tbl_announcementdata tbody').off( 'click', '.editLink' ).on( 'click', '.editLink', function (e) {
        e.preventDefault();
                   
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName    = $('.txt_csrfname').attr('name');
        var csrfHash    = $('.txt_csrfname').val();
        if (typeof(data_row) != "undefined"){        
            
            $.ajax({
            url:baseUrl+'common/get_selected_row/tbl_announcement/id/'+data_row.id,
            type: 'POST',
            dataType: 'json', 
            data:{[csrfName]: csrfHash},
            dataType: 'json',
            success:function(data,json){
                $('.txt_csrfname').val(data.token); 
                document.getElementById("txt_announcement_heading").value = data.response[0].announcement_heading;
                document.getElementById("txt_announcement").value = data.response[0].announcement;
                document.getElementById("announcement_type").value = data.response[0].announcement_type;
                dataArr = data.response[0].group_id;
                if(dataArr.length > 0){
                    $('#visibility_group').val(dataArr);
                    $('#visibility_group').trigger('change');
                }
                $('#visibility_status').val(data.response[0].status);
                document.getElementById("txt_announcement_id").value = data.response[0].id;
            },
            complete: function(){
            },
            error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
            });
        }
    });
}

/*--------------------------------------------------*/
/* Load Payments Data
/*--------------------------------------------------*/
function loadPaymentsData(){
    var csrfName    = $('.txt_csrfname').attr('name');
    var csrfHash    = $('.txt_csrfname').val();
    var table       = $('#tbl_paymentsdata').DataTable( {
    destroy:true,
    "ajax": {
    "type" : "GET",
    "url" : baseUrl+'common/get_table_data/tbl_payments',
    "data": {[csrfName]: csrfHash},
    "success": function (data,json) {
        $('.txt_csrfname').val(data.token); 
        getPaymentsData(data.response);
    }}
    });
}

/*--------------------------------------------------*/
/*  Payments Data Controls
/*--------------------------------------------------*/
function getPaymentsData(data){
    var csrfName    = $('.txt_csrfname').attr('name');
    var csrfHash    = $('.txt_csrfname').val();
    $.getJSON(baseUrl+'common/get_table_data/tbl_users',{[csrfName]: csrfHash},function(userData){
    var table = $('#tbl_paymentsdata').DataTable({
    destroy: true,
    data : data,
    "columns": [
    { "data": 'PAYMENT_ID' },
    { "data": 'USER_ID' },
    { "data": 'ACK' },
    { "data": 'AMOUNT' },
    { "data": 'PLAN_ID' },
    { "data": 'METHOD' },
    { "data": 'TIMESTAMP' },
    ],
    "order": [[1, 'asc']],
    dom: 'Bfrtip',
    buttons: [
    { "extend": 'copy', "text":'Copy',"className": 'btn btn-warning btn-xs' }, { "extend": 'csv', "text":'CSV',"className": 'btn btn-success btn-xs' }
    ,{ "extend": 'excel', "text":'Excel',"className": 'btn btn-info btn-xs' }, { "extend": 'pdf', "text":'PDF',"className": 'btn btn-danger btn-xs' }
    ,{ "extend": 'print', "text":'Print',"className": 'btn btn-primary btn-xs' }
    ],
    "createdRow": function( row, data, dataIndex ) {
        $('td', row).eq(1).html(userData.response.filter(p => p.user_id === data.USER_ID)[0].username);
        if (data.ACK =='Success') {
            $('td', row).eq(2).html("<label class='badge badge-success'>Success</label>");
        }
        else 
        { 
            $('td', row).eq(2).html("<label class='badge badge-danger'>"+data.ACK+"</label>");
        }
    },
    });
    });
}


/*--------------------------------------------------*/
/* Load Sponsored & Regular Listings
/*--------------------------------------------------*/
function loadAnyListingsData(){
    var csrfName    = $('.txt_csrfname').attr('name');
    var csrfHash    = $('.txt_csrfname').val();
    var table       = $('#tbl_anylistings').DataTable( {
    destroy:true,
    "ajax": {
    "type" : "GET",
    "url" : baseUrl+'common/get_table_data/tbl_purchases',
    "data": {[csrfName]: csrfHash},
    "success": function (data,json) {
        $('.txt_csrfname').val(data.token);  
        getAnyListingsData(data.response);
    }}
    });
}

/*--------------------------------------------------*/
/*  Sponsored & Regular Listings Data Controls
/*--------------------------------------------------*/
function getAnyListingsData(data){
    var csrfName    = $('.txt_csrfname').attr('name');
    var csrfHash    = $('.txt_csrfname').val();
    $.getJSON(baseUrl+'common/get_table_data/tbl_purchases',{[csrfName]: csrfHash},function(userData){
    $('.txt_csrfname').val(data.token);  
    var table = $('#tbl_anylistings').DataTable({
    destroy: true,
    data : data,
    "columns": [
    { "data": 'invoice_id' },
    { "data": 'listing_type' },
    { "data": 'purchase_date' },
    { "data": 'expire_date' }
    ],
    "order": [[1, 'asc']],
    dom: 'Bfrtip',
    buttons: [
    { "extend": 'copy', "text":'Copy',"className": 'btn btn-warning btn-xs' }, { "extend": 'csv', "text":'CSV',"className": 'btn btn-success btn-xs' }
    ,{ "extend": 'excel', "text":'Excel',"className": 'btn btn-info btn-xs' }, { "extend": 'pdf', "text":'PDF',"className": 'btn btn-danger btn-xs' }
    ,{ "extend": 'print', "text":'Print',"className": 'btn btn-primary btn-xs' }
    ],
    "createdRow": function( row, data, dataIndex ) {
    },
    });
    });
}


/*--------------------------------------------------*/
/* Load Withdrawals
/*--------------------------------------------------*/
function loadWithdrawalsData(status){
    var csrfName    = $('.txt_csrfname').attr('name');
    var csrfHash    = $('.txt_csrfname').val();
    var table       = $('#tbl_withdrawals').DataTable( {
    destroy:true,
    "ajax": {
    "type" : "GET",
    "url" : baseUrl+'common/withdrawals_data/'+status,
    "data": {[csrfName]: csrfHash},
    "success": function (data,json) {
        $('.txt_csrfname').val(data.token); 
        getWithdrawalsData(data.response);
    }}
    });
}

/*--------------------------------------------------*/
/*  Withdrawals Data Controls
/*--------------------------------------------------*/
function getWithdrawalsData(data){
    var table = $('#tbl_withdrawals').DataTable( {
    destroy: true,
    data : data,
    "columns": [
    { "data": 'withdrawal_id' },
    { "data": 'username' },
    { "data": 'methodw' },
    { "data": 'final_amount' },
    { "data": 'fee' },
    { "data": 'created_date' },
    { "data": 'statusw' },
    {
        "data": null,
        "className": 'center',
        "defaultContent": '<a href="" class="inactiveClick"><i title="Reject Request" class="fa fa-ban" aria-hidden="true"></a>'
    },
    {
        "data": null,
        "className": 'center',
        "defaultContent": '<a href="" class="activeClick"><i title="Mark as Completed" class="fa fa-check" aria-hidden="true"></a>'
    },
    ],
    "order": [[1, 'asc']],
    dom: 'Bfrtip',
    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
    "createdRow": function( row, data, dataIndex ) {
    $('td', row).eq(2).html("<a href='#' class='viewUser'>"+data.methodw+"</a>");
    if (data.statusw ==='0') {
        $('td', row).eq(7).html('<a href="" class="inactiveClick"><i title="Reject Request" class="fa fa-ban" aria-hidden="true"></a>');
        $('td', row).eq(8).html('<a href="" class="activeClick"><i title="Mark as Completed" class="fa fa-check" aria-hidden="true"></a>');     
        $('td', row).eq(6).html("<label class='badge badge-info'>Pending for Approval</label>");
    }
    else if(data.statusw ==='2' ) {
        $('td', row).eq(7).html("");
        $('td', row).eq(8).html(""); 
        $('td', row).eq(6).html("<label class='badge badge-success'>Paid</label>");
    }
    else if(data.statusw ==='3' ) {
        $('td', row).eq(7).html("");
        $('td', row).eq(8).html(""); 
        $('td', row).eq(6).html("<label class='badge badge-danger'>Rejected</label>");
    }
    },
    });

    $('#tbl_withdrawals tbody').off( 'click', '.viewUser' ).on( 'click', '.viewUser', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        if (typeof(data_row) != "undefined"){
            $('#paypal_email').val(data_row.paypal);
            $('#payoneer_email').val(data_row.payoneer);
            $('#bank_accountname').val(data_row.bank_transfer);
            $('#modal-userpaymentinfo').modal('show'); 
        }
    });
    

    $('#tbl_withdrawals tbody').off( 'click', '.inactiveClick' ).on( 'click', '.inactiveClick', function (e) {
        e.preventDefault();
        var data_row    = table.row($(this).closest('tr')).data();
        var csrfName    = $('.txt_csrfname').attr('name');
        var csrfHash    = $('.txt_csrfname').val();
        if (typeof(data_row) != "undefined"){
            if (confirm('Confirm Withdrawal Request Rejection ?')) {
                                    
                window.location.href = '#';
                $('#loaderapp').show();             
                $.ajax({
                url:baseUrl+'common/update_selected__withdrawal/tbl_withdrawals/status/3/id/'+data_row.id,
                type: 'POST',
                data:{[csrfName]: csrfHash},
                dataType: 'json', 
                success:function(data){
                $('.txt_csrfname').val(data.token);
                $('#loaderapp').hide(); 
                loadWithdrawalsData();
                },
                complete: function(){
                $('#loaderapp').hide(); 
                },
                error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
                });
            }
        }
    });

    $('#tbl_withdrawals tbody').off( 'click', '.activeClick' ).on( 'click', '.activeClick', function (e) {
        e.preventDefault();
        var data_row    = table.row($(this).closest('tr')).data();
        var csrfName    = $('.txt_csrfname').attr('name');
        var csrfHash    = $('.txt_csrfname').val();
        if (typeof(data_row) != "undefined"){
            if (confirm('Confirm Withdrawal Request Approval ?')) {
                                    
                window.location.href = '#';
                $('#loaderapp').show();               
                $.ajax({
                url:baseUrl+'common/update_selected__withdrawal/tbl_withdrawals/status/2/id/'+data_row.id,
                type: 'POST', 
                data:{[csrfName]: csrfHash},
                dataType: 'json',
                success:function(data){ 
                $('.txt_csrfname').val(data.token);
                $('#loaderapp').hide();
                loadWithdrawalsData();
                $('#loaderapp').hide();
                },
                complete: function(){
                },
                error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
                });
            }
        }
    });
}


/*--------------------------------------------------*/
/* Load Reported Data
/*--------------------------------------------------*/
function loadReportedData(status){
    var csrfName    = $('.txt_csrfname').attr('name');
    var csrfHash    = $('.txt_csrfname').val();
    var table       = $('#tbl_ReportedData').DataTable( {
    destroy:true,
    "ajax": {
    "type" : "GET",
    "url" : baseUrl+'common/get_reported_data/tbl_reports',
    "data": {[csrfName]: csrfHash},
    "success": function (data,json) {
        $('.txt_csrfname').val(data.token);  
        getReportedData(data.response);
    }}
    });
}

/*--------------------------------------------------*/
/*  Reported Data Controls
/*--------------------------------------------------*/
function getReportedData(data){
    var table = $('#tbl_ReportedData').DataTable( {
    destroy: true,
    data : data,
    "columns": [
    { "data": 'website_BusinessName' },
    { "data": 'username' },
    { "data": 'reason' },
    {
        "data": null,
        "className": 'center',
        "defaultContent": '<a href="" class="inactiveClick"><i title="Reject Request" class="fa fa-ban" aria-hidden="true"></a>'
    },
    {
        "data": null,
        "className": 'center',
        "defaultContent": '<a href="" class="activeClick"><i title="Mark as Completed" class="fa fa-check" aria-hidden="true"></a>'
    },
    ],
    "order": [[1, 'asc']],
    dom: 'Bfrtip',
    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
    "createdRow": function( row, data, dataIndex ) {
    if (data.statusw ==='0') {
        $('td', row).eq(7).html('<a href="" class="inactiveClick"><i title="Reject Request" class="fa fa-ban" aria-hidden="true"></a>');
        $('td', row).eq(8).html('<a href="" class="activeClick"><i title="Mark as Completed" class="fa fa-check" aria-hidden="true"></a>');     
        $('td', row).eq(6).html("<label class='badge badge-info'>Pending for Approval</label>");
    }

    },
    });
    

    $('#tbl_ReportedData tbody').off( 'click', '.inactiveClick' ).on( 'click', '.inactiveClick', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName    = $('.txt_csrfname').attr('name');
        var csrfHash    = $('.txt_csrfname').val();
        if (typeof(data_row) != "undefined"){
            if (confirm('Reject Listing Complaint ?')) {
                                    
                window.location.href = '#';
                                
                $.ajax({
                url:baseUrl+'common/reject_complaint/'+data_row.id,
                type: 'POST', 
                data:{[csrfName]: csrfHash},
                dataType: 'json',
                success:function(data){ 
                $('.txt_csrfname').val(data.token); 
                loadReportedData();
                },
                complete: function(){
                },
                error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
                });
            }
        }
    });

    $('#tbl_ReportedData tbody').off( 'click', '.activeClick' ).on( 'click', '.activeClick', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        if (typeof(data_row) != "undefined"){
            if (confirm('Accept Listing Complaint & Delete this listing?')) {
                                    
                window.location.href = '#';
                                
                $.ajax({
                url:baseUrl+'common/accept_complaint/'+data_row.id,
                type: 'POST', 
                data:{[csrfName]: csrfHash},
                dataType: 'json',
                success:function(data){ 
                $('.txt_csrfname').val(data.token); 
                loadReportedData();
                },
                complete: function(){
                },
                error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
                });
            }
        }
    });
} 

/*--------------------------------------------------*/
/* Load Languages
/*--------------------------------------------------*/
function loadLanguageData(){
    var csrfName    = $('.txt_csrfname').attr('name');
    var csrfHash    = $('.txt_csrfname').val();
    var table       = $('#tbl_languages').DataTable( {
    destroy:true,
    "ajax": {
    "type": "GET",
    "url" : baseUrl+'common/get_table_data/tbl_languages',
    "data": {[csrfName]: csrfHash},
    "success": function (data,json) {
        $('.txt_csrfname').val(data.token);
        getLanguageData(data.response);
    }}
    });
}

/*--------------------------------------------------*/
/* Languages Data Controls
/*--------------------------------------------------*/  
function getLanguageData(data){

    var table = $('#tbl_languages').DataTable({
    destroy: true,
    data : data,
    "columns": [
    { "data": 'language' },
    { "data": 'language_code' },
    {
        "data": null,
        "className": 'center',
        "defaultContent": ''
    },
    {
        "data": null,
        "className": 'center',
        "defaultContent": '<a href="" class="editLink"><i class="fa fa-pencil-square-o" aria-hidden="true"></a>'
    },
    {
        "data": null,
        "className": 'center',
        "defaultContent": '<a href="" class="deleteLink"><i class="fa fa fa-trash" aria-hidden="true"></a>'
    },
    {   
        "data": null,
        "className": 'center',
        "defaultContent": '<a href="" class="defaultLanguage">Set Default</a>'
    }
    ],
    "order": [[1, 'asc']],
    dom: 'Bfrtip',
    buttons: [
    'copy', 'csv', 'excel', 'pdf', 'print'
    ],
    "createdRow": function( row, data, dataIndex ) {

    if(data.language_code !== 'en'){

        if(data.status=='1'){
            $('td', row).eq(2).html("<label class='badge badge-success'>"+'Active'+"</label>");
        }

        else
        {
            $('td', row).eq(2).html("<label class='badge badge-danger'>"+'Inactive'+"</label>");
        }

        if(data.default_status  ==  '1'){
            $('td', row).eq(5).html("Default");
        }
    }
    else
    {
        $('td', row).eq(2).html("<label class='badge badge-success'>"+'Active'+"</label>");
        $('td', row).eq(3).html("");
        $('td', row).eq(4).html("");

        if(data.default_status  ==  '1'){
            $('td', row).eq(5).html("Default");
        }
    }
    },
    });


    $('#tbl_languages tbody').off( 'click', '.deleteLink' ).on( 'click', '.deleteLink', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName    = $('.txt_csrfname').attr('name');
        var csrfHash    = $('.txt_csrfname').val();
        if (typeof(data_row) != "undefined"){
            if(data_row.language_code!=='en' && data_row.default_status!=='1'){
                if (confirm('Confirm delete post')) {
                                    
                window.location.href = '#';
                                
                $.ajax({
                url:baseUrl+'common/delete__language_from_table/tbl_languages/id/'+data_row.id,
                type: 'POST', 
                data:{[csrfName]: csrfHash},
                dataType: 'json',
                success:function(data){
                $('.txt_csrfname').val(data.token);   
                loadLanguageData();
                },
                complete: function(){

                },
                error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
                });
            }
        }
        else
        {
            confirm('Sorry !! You Cannot Delete Deafult Language');
        }
    }
    });


    $('#tbl_languages tbody').off( 'click', '.defaultLanguage' ).on( 'click', '.defaultLanguage', function (e) {
        e.preventDefault();
        var data_row = table.row($(this).closest('tr')).data();
        var csrfName    = $('.txt_csrfname').attr('name');
        var csrfHash    = $('.txt_csrfname').val();
        if (typeof(data_row) != "undefined"){
            if (confirm('Set '+data_row.language+' language as Default?')) {
                                    
                window.location.href = '#';
                                
                $.ajax({
                url:baseUrl+'common/set_default_language/'+data_row.id,
                type: 'POST', 
                data:{[csrfName]: csrfHash},
                dataType: 'json',
                success:function(data){ 
                $('.txt_csrfname').val(data.token);  
                loadLanguageData();
                },
                complete: function(){
                },
                error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
            });
            }
        }
    });
    

    $('#tbl_languages tbody').off( 'click', '.editLink' ).on( 'click', '.editLink', function (e) {
            e.preventDefault();
            var data_row = table.row($(this).closest('tr')).data();
            var csrfName    = $('.txt_csrfname').attr('name');
            var csrfHash    = $('.txt_csrfname').val();
            if (typeof(data_row) != "undefined"){        
                $.ajax({
                url:baseUrl+'common/get_selected_row/tbl_languages/id/'+data_row.id,
                type: 'POST',
                dataType: 'json', 
                data:{[csrfName]: csrfHash},
                dataType: 'json',
                success:function(data,json){ 
                $('.txt_csrfname').val(data.token);
                document.getElementById("language_id").value = data.response[0].id;
                document.getElementById("language_code").value = data.response[0].language_code;
                document.getElementById("language_name").value = data.response[0].language;
                $('#language_active').val(data.response[0].status).change();
                $('#default_status').val(data.response[0].default_status).change();
                document.getElementById("language_code").disabled = false;
                document.getElementById("language_name").disabled = false;
                document.getElementById("language_icon").disabled = false;
                document.getElementById("language_active").disabled = false;
                document.getElementById('language_button').innerHTML = 'Save Changes';

                },
                complete: function(){
                },
                error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
                });
            }
    });
}