/*---------------------------------------------------------
jQuery Required for Slippa Script by Onlinetoolhub
Project:    Slippa - Domain & Website Marketplace -  V 1.0
Version:    V 1.0
Last change:    20.04.2020
Assigned to:    Onlinetoolhub
----------------------------------------------------------*/


/*--------------------------------------------------*/
/*  Load Years Dropdown
/*--------------------------------------------------*/
function loadYears(id,select='') {
    var currentYear = (new Date()).getFullYear();
    for (var i = 1990; i <= currentYear; i++) {
        var option = $("<option />");
        option.html(i);
        option.val(i);
        $('#'+id).append(option);
    }
    if(select ===''){
    	$('#'+id).val(currentYear);
    	return;
    }
    $('#'+id).val(select);
}

/*--------------------------------------------------*/
/*  Cuurent Year Comparison Change event
/*--------------------------------------------------*/
$(document).on('change', '#year_cur_drop', function(e){ 
	ListingComparison('lineChart',$("#year_cur_drop").val(),$("#year_prev_drop").val());
});

/*--------------------------------------------------*/
/* Previous Year Comparison Change event
/*--------------------------------------------------*/
$(document).on('change', '#year_prev_drop', function(e){ 
	ListingComparison('lineChart',$("#year_cur_drop").val(),$("#year_prev_drop").val());
});

/*--------------------------------------------------*/
/* Previous Year Comparison Change event
/*--------------------------------------------------*/
$(document).on('change', '#years_drop', function(e){ 
	loadUserwiseMonthlyWiseTotalEarnings('monthluserwisechart',$("#years_drop").val());
});

/*--------------------------------------------------*/
/*  Years Wise Comparisons
/*--------------------------------------------------*/
"use strict";
function ListingComparison(id,year='',prevYear='') {
    var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();

    $.ajax({   
    method :'GET',
    url:baseUrl+'admin/get_monthlywisetotallistings/'+year+'/'+prevYear,
    dataType: 'json',
    success:function(data){ 
    $('.txt_csrfname').val(data.token); 
    if(data.response !== ''){
    	var ctx1 = document.getElementById(id).getContext('2d');
   	 	var lineChart = new Chart(ctx1, {
    	type: 'bar',
    	data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
      	datasets: [{
            	label: year,
            	backgroundColor: '#3EB9DC',
            	data: getDataVals(data.response[0],1) 
    	}, {
    	    	label: prevYear,
            	backgroundColor: '#EBEFF3',
            	data: getDataVals(data.response[1],1)
    	}]
                
    	},
    	// Configuration options
		options: {

		    layout: {
		      padding: 10,
		  	},

			legend: { display: false },
			title:  { display: false },

			scales: {
				yAxes: [{
					scaleLabel: {
						display: false
					},
					gridLines: {
						 borderDash: [6, 10],
						 color: "#d8d8d8",
						 lineWidth: 1,
	            	},
				}],
				xAxes: [{
					scaleLabel: { display: false },  
					gridLines:  { display: false },
				}],
			},

		    tooltips: {
		      backgroundColor: '#333',
		      titleFontSize: 13,
		      titleFontColor: '#fff',
		      bodyFontColor: '#fff',
		      bodyFontSize: 13,
		      displayColors: false,
		      xPadding: 10,
		      yPadding: 10,
		      intersect: false
		    }
		},
    	});
   	}
   	else
	{
		var ctx1 = document.getElementById(id).getContext('2d');
	}
    },
    complete: function(){
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });
}

/*--------------------------------------------------*/
/*  Monthly Wise Comparisons
/*--------------------------------------------------*/
"use strict";
function loadUserwiseMonthlyWiseTotalEarnings(id,year=''){
	Chart.defaults.global.defaultFontFamily = "Nunito";
	Chart.defaults.global.defaultFontColor = '#888';
	Chart.defaults.global.defaultFontSize = '14';

	var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();

	$.ajax({   
    method :'GET',
    url:baseUrl+'common/get_userwisemonthlyearnings/'+year+'/'+userID,
    dataType: 'json',
    success:function(data){
    $('.txt_csrfname').val(data.token); 
    if(data.response !== ''){
    	data 	= data.response;
		var ctx = document.getElementById(id).getContext('2d');

		var chart = new Chart(ctx, {
		type: 'line',

		// The data for our dataset
		data: {
			labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
	   		datasets: [{
				label: "Total Earnings",
				backgroundColor: 'rgba(35,69,23,0.08)',
				borderColor: '#722396',
				borderWidth: "3",
				data: getDataVals(data,1),
				pointRadius: 5,
				pointHoverRadius:5,
				pointHitRadius: 10,
				pointBackgroundColor: "#fff",
				pointHoverBackgroundColor: "#fff",
				pointBorderWidth: "2",
			}]
		},

		// Configuration options
		options: {

		    layout: {
		      padding: 10,
		  	},

			legend: { display: false },
			title:  { display: false },

			scales: {
				yAxes: [{
					scaleLabel: {
						display: false
					},
					gridLines: {
						 borderDash: [6, 10],
						 color: "#d8d8d8",
						 lineWidth: 1,
	            	},
				}],
				xAxes: [{
					scaleLabel: { display: false },  
					gridLines:  { display: false },
				}],
			},

		    tooltips: {
		      backgroundColor: '#333',
		      titleFontSize: 13,
		      titleFontColor: '#fff',
		      bodyFontColor: '#fff',
		      bodyFontSize: 13,
		      displayColors: false,
		      xPadding: 10,
		      yPadding: 10,
		      intersect: false
		    }
		},
	});
	}
	else
	{
		var ctx = document.getElementById(id).getContext('2d');
	}

	},
    complete: function(){
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });
}

/*--------------------------------------------------*/
/*  Monthly Wise Total User Earnings Comparisons
/*--------------------------------------------------*/
"use strict";
function loadMonthlyWiseTotalEarnings(id,year=''){
	Chart.defaults.global.defaultFontFamily = "Nunito";
	Chart.defaults.global.defaultFontColor = '#888';
	Chart.defaults.global.defaultFontSize = '14';

	var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();

	$.ajax({   
    method :'GET',
    url:baseUrl+'admin/get_monthlywisetotalearnings/'+year,
    dataType: 'json',
    success:function(data){ 
    $('.txt_csrfname').val(data.token);
    if(data.response !== ''){
    	data 	= data.response;
		var ctx = document.getElementById(id).getContext('2d');

		var chart = new Chart(ctx, {
		type: 'line',

		// The data for our dataset
		data: {
			labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
	   		datasets: [{
				label: "Total Earnings",
				backgroundColor: 'rgba(35,69,23,0.08)',
				borderColor: '#722396',
				borderWidth: "3",
				data: getDataVals(data,1),
				pointRadius: 5,
				pointHoverRadius:5,
				pointHitRadius: 10,
				pointBackgroundColor: "#fff",
				pointHoverBackgroundColor: "#fff",
				pointBorderWidth: "2",
			}]
		},

		// Configuration options
		options: {

		    layout: {
		      padding: 10,
		  	},

			legend: { display: false },
			title:  { display: false },

			scales: {
				yAxes: [{
					scaleLabel: {
						display: false
					},
					gridLines: {
						 borderDash: [6, 10],
						 color: "#d8d8d8",
						 lineWidth: 1,
	            	},
				}],
				xAxes: [{
					scaleLabel: { display: false },  
					gridLines:  { display: false },
				}],
			},

		    tooltips: {
		      backgroundColor: '#333',
		      titleFontSize: 13,
		      titleFontColor: '#fff',
		      bodyFontColor: '#fff',
		      bodyFontSize: 13,
		      displayColors: false,
		      xPadding: 10,
		      yPadding: 10,
		      intersect: false
		    }
		},
	});
	}
	else
	{
		var ctx = document.getElementById(id).getContext('2d');
	}

	},
    complete: function(){
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });
}


/*--------------------------------------------------*/
/*  Listing Traffic Chart infos
/*--------------------------------------------------*/
"use strict";	
function loadDomainTrafficData(id){
	Chart.defaults.global.defaultFontFamily = "Nunito";
	Chart.defaults.global.defaultFontColor = '#888';
	Chart.defaults.global.defaultFontSize = '14';

	var csrfName = $('.txt_csrfname').attr('name');
    var csrfHash = $('.txt_csrfname').val();

	$.ajax({   
    method :'GET',
    url:baseUrl+'analytics/getSiteAnalyticsdata/'+$('#listingidwebsite').val(),
    dataType: 'json',
    success:function(data){ 
    $('.txt_csrfname').val(data.token);	
    if(data.response !== ''){
		var ctx = document.getElementById(id).getContext('2d');

		var chart = new Chart(ctx, {
		type: 'line',

		// The data for our dataset
		data: {
			labels: getLabels(data.response),
	   		datasets: [{
				label: "Users",
				backgroundColor: 'rgba(42,65,232,0.08)',
				borderColor: '#2a41e8',
				borderWidth: "3",
				data: getDatavalues(data.response,2),
				pointRadius: 5,
				pointHoverRadius:5,
				pointHitRadius: 10,
				pointBackgroundColor: "#fff",
				pointHoverBackgroundColor: "#fff",
				pointBorderWidth: "2",
			},{
				label: "Page Views",
				backgroundColor: 'rgba(35,69,23,0.08)',
				borderColor: '#722626',
				borderWidth: "3",
				data: getDatavalues(data.response,3),
				pointRadius: 5,
				pointHoverRadius:5,
				pointHitRadius: 10,
				pointBackgroundColor: "#fff",
				pointHoverBackgroundColor: "#fff",
				pointBorderWidth: "2",
			}]
		},

		// Configuration options
		options: {

		    layout: {
		      padding: 10,
		  	},

			legend: { display: false },
			title:  { display: false },

			scales: {
				yAxes: [{
					scaleLabel: {
						display: false
					},
					gridLines: {
						 borderDash: [6, 10],
						 color: "#d8d8d8",
						 lineWidth: 1,
	            	},
				}],
				xAxes: [{
					scaleLabel: { display: false },  
					gridLines:  { display: false },
				}],
			},

		    tooltips: {
		      backgroundColor: '#333',
		      titleFontSize: 13,
		      titleFontColor: '#fff',
		      bodyFontColor: '#fff',
		      bodyFontSize: 13,
		      displayColors: false,
		      xPadding: 10,
		      yPadding: 10,
		      intersect: false
		    }
		},
	});
	}
	else
	{
		var ctx = document.getElementById(id).getContext('2d');
	}

	},
    complete: function(){
    },
    error:function (xhr, ajaxOptions, thrownError){alert(thrownError);}
    });
}

/*--------------------------------------------------*/
/*  Get Relevant Labels Data for Charts
/*--------------------------------------------------*/
function getLabels(response){
    var arrLabels=[];
    for (var i=0; i<response.length;i++)
    {
        arrLabels[i]	=	response[i][1]+' - '+response[i][0]
    }
    return arrLabels;
}


/*--------------------------------------------------*/
/*  Get Relevant Values for Charts
/*--------------------------------------------------*/
function getDatavalues(response,index){
    var arr=[];
    for (var i=0; i<response.length;i++){
       arr[i]=response[i][index];
    }
    return arr;
}


/*--------------------------------------------------*/
/*  Get Relevant Values for Charts
/*--------------------------------------------------*/
function getDataVals(response){
    var arr=[];
    for (var i=0; i<response.length;i++){
       arr[i]=response[i];
    }
    return arr;
}

