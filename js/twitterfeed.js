$(document).ready(function () {
	updateFeed();
	updatePopular();
	scrollPopular();
	setInterval(updateFeed,30000);
	setInterval(updatePopular,32000);
	setInterval(scrollPopular,8000);
});

var popularTweets = [];

function updatePopular(){
	$.getJSON('tweets_popular.json?'+Math.random(),
					function(response){
						popularTweets = response.statuses;
					});
    			
}

function scrollPopular(){
	if(popularTweets.length == 0) return;

	var nextTweet = popularTweets.shift();
	$("#tw-destacados p:last-child").html(nextTweet.text);
	$("#tw-destacados p:first-child").animate({marginTop:'-60px', opacity:0}, 1500, function(){
		$("#tw-destacados p:last-child").after($("#tw-destacados p:first-child"));
		$("#tw-destacados p:last-child").css({marginTop:'0px'});
	});
	$("#tw-destacados p:last-child").animate({opacity:1}, 1500);
	popularTweets.push(nextTweet);
}

function updateFeed(){
 	var displaylimit = 30;
	var screenname = "#TuVotasTVX";
   var showdirecttweets = false;
   var showretweets = true;
   var showtweetlinks = true;
   var showprofilepic = true;
   var showtweetactions = true;
	var showretweetindicator = true;
	
	var headerHTML = '';
	var loadingHTML = '';
	headerHTML += '<a href="https://twitter.com/" target="_blank"><img src="img/twitter-bird-light.png" style="float:left; margin-right:15px; margin-top: 10px;" alt="twitter bird" /></a>';
	// headerHTML += '<a href="https://twitter.com/" target="_blank"><img src="img/twitter-bird-light.png" width="34" style="float:left;padding:3px 12px 0px 6px" alt="twitter bird" /></a>';
	headerHTML += '<h1>'+screenname+'</h1>';
	//loadingHTML += '<div id="loading-container"><img src="img/ajax-loader.gif" width="32" height="32" alt="tweet loader" /></div>';
	
	 //$('#twitter-feed').html(headerHTML + loadingHTML);
	 
    $.getJSON('tweets_recent.json?'+Math.random(),
        function(response) {
        		var feeds = response.statuses;   
            var feedHTML = headerHTML + '<div class="scroll_content" style="overflow:auto; max-height:360px">';
            var displayCounter = 1;         
            for (var i=0; i<feeds.length; i++) {
					var tweetscreenname = feeds[i].user.name;
		         var tweetusername = feeds[i].user.screen_name;
		         var profileimage = feeds[i].user.profile_image_url_https;
		         var status = feeds[i].text; 
					var isaretweet = false;
					var isdirect = false;
					var tweetid = feeds[i].id_str;
					
					//If the tweet has been retweeted, get the profile pic of the tweeter
					if(typeof feeds[i].retweeted_status != 'undefined'){
					   profileimage = feeds[i].retweeted_status.user.profile_image_url_https;
					   tweetscreenname = feeds[i].retweeted_status.user.name;
					   tweetusername = feeds[i].retweeted_status.user.screen_name;
					   tweetid = feeds[i].retweeted_status.id_str;
					   status = feeds[i].retweeted_status.text; 
					   isaretweet = true;
					};
					 
					 
					 //Check to see if the tweet is a direct message
					if (feeds[i].text.substr(0,1) == "@") {
						 isdirect = true;
					}
					 
					 //Generate twitter feed HTML based on selected options
					if (((showretweets == true) || ((isaretweet == false) && (showretweets == false))) && ((showdirecttweets == true) || ((showdirecttweets == false) && (isdirect == false)))) { 
						if ((feeds[i].text.length > 1) && (displayCounter <= displaylimit)) {       
							if (showtweetlinks == true) {
								status = addlinks(status); 
							}

							feedHTML += '<div class="twitter-article" id="tw'+displayCounter+'">'; 										                 
							feedHTML += '<div class="twitter-pic"><a href="https://twitter.com/'+tweetusername+'" target="_blank"><img src="'+profileimage+'"images/twitter-feed-icon.png" width="42" height="42" alt="twitter icon" /></a></div>';
							feedHTML += '<div class="twitter-text"><p><span class="tweetprofilelink"><strong><a href="https://twitter.com/'+tweetusername+'" target="_blank">'+tweetscreenname+'</a></strong> <a href="https://twitter.com/'+tweetusername+'" target="_blank">@'+tweetusername+'</a></span><span class="tweet-time"><a href="https://twitter.com/'+tweetusername+'/status/'+tweetid+'" target="_blank">'+relative_time(feeds[i].created_at)+'</a></span><br/>'+status+'</p>';
							
							if ((isaretweet == true) && (showretweetindicator == true)) {
								feedHTML += '<div id="retweet-indicator"></div>';
							}						
										
							if (showtweetactions == true) {
								feedHTML += '<div id="twitter-actions"><div class="intent" id="intent-reply"><a href="https://twitter.com/intent/tweet?in_reply_to='+tweetid+'" title="Reply"></a></div><div class="intent" id="intent-retweet"><a href="https://twitter.com/intent/retweet?tweet_id='+tweetid+'" title="Retweet"></a></div><div class="intent" id="intent-fave"><a href="https://twitter.com/intent/favorite?tweet_id='+tweetid+'" title="Favourite"></a></div></div>';
							}

							feedHTML += '</div>';
							feedHTML += '</div>';
							displayCounter++;
						}   
					}
         	}
             
         feedHTML += '</div>'
         $('#twitter-feed').html(feedHTML);

			//Add twitter action animation and rollovers
			if (showtweetactions == true) {				
				$('.twitter-article').hover(function(){
					$(this).find('#twitter-actions').css({'display':'block', 'opacity':0, 'margin-top':-20});
					$(this).find('#twitter-actions').animate({'opacity':1, 'margin-top':0},200);
				}, function() {
					$(this).find('#twitter-actions').animate({'opacity':0, 'margin-top':-20},120, function(){
						$(this).css('display', 'none');
					});
				});			
			
				//Add new window for action clicks
			
				$('#twitter-actions a').click(function(){
					var url = $(this).attr('href');
				  window.open(url, 'tweet action window', 'width=580,height=500');
				  return false;
				});
			}
			
			
    }).error(function(jqXHR, textStatus, errorThrown) {
		var error = "";
			 if (jqXHR.status === 0) {
               error = 'Connection problem. Check file path and www vs non-www in getJSON request';
            } else if (jqXHR.status == 404) {
                error = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                error = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                error = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                error = 'Time out error.';
            } else if (exception === 'abort') {
                error = 'Ajax request aborted.';
            } else {
                error = 'Uncaught Error.\n' + jqXHR.responseText;
            }	
       		console.error("error: " + error);
    });
}

//Function modified from Stack Overflow
function addlinks(data) {
  //Add link to all http:// links within tweets
	data = data.replace(/((https?|s?ftp|ssh)\:\/\/[^"\s\<\>]*[^.,;'">\:\s\<\>\)\]\!])/g, function(url) {
      return '<a href="'+url+'"  target="_blank">'+url+'</a>';
  	});
       
  	//Add link to @usernames used within tweets
  	data = data.replace(/\B@([_a-z0-9]+)/ig, function(reply) {
      return '<a href="http://twitter.com/'+reply.substring(1)+'" style="font-weight:lighter;" target="_blank">'+reply.charAt(0)+reply.substring(1)+'</a>';
  	});

	//Add link to #hastags used within tweets
  	data = data.replace(/\B#([_a-z0-9]+)/ig, function(reply) {
      return '<a href="https://twitter.com/search?q='+reply.substring(1)+'" style="font-weight:lighter;" target="_blank">'+reply.charAt(0)+reply.substring(1)+'</a>';
  	});
  	return data;
}


function relative_time(time_value) {
	var values = time_value.split(" ");
	time_value = values[1] + " " + values[2] + ", " + values[5] + " " + values[3];
	var parsed_date = Date.parse(time_value);
	var relative_to = (arguments.length > 1) ? arguments[1] : new Date();
	var delta = parseInt((relative_to.getTime() - parsed_date) / 1000);
	var shortdate = time_value.substr(4,2) + " " + time_value.substr(0,3);
	delta = delta + (relative_to.getTimezoneOffset() * 60);

	if (delta < 60) {
	  return '1m';
	} else if(delta < 120) {
	  return '1m';
	} else if(delta < (60*60)) {
	  return (parseInt(delta / 60)).toString() + 'm';
	} else if(delta < (120*60)) {
	  return '1h';
	} else if(delta < (24*60*60)) {
	  return (parseInt(delta / 3600)).toString() + 'h';
	} else if(delta < (48*60*60)) {
	  //return '1 day';
	return shortdate;
	} else {
	  return shortdate;
	}
}

function tweetcarousel() {
  var currenttweet = 1;
  var totaltweets = 30;
  var slideinitial = true;
  var tweetshift = 4;
  var slidetime = 3;
  var pausetime = 10;
  var lasttweet = totaltweets;
  var tweetheight = new Array();
  var totalheight  = 0;             
  var sliderheight = $("#twitter-feed").height();
   
  for (var i=1; i<=totaltweets; i++) {
      tweetheight[i] = parseInt($('#tw'+i).css('height')) + parseInt($('#tw'+i).css('padding-top')) + parseInt($('#tw'+i).css('padding-bottom'));
      if (slideinitial == false) {
          sliderheight = 0;
      }
      if (i > 1) {
           
          $('#tw'+i).css('top', tweetheight[i-1] + totalheight + sliderheight);
          $('#tw'+i).animate({'top':tweetheight[i-1]+ totalheight}, slidetime);                      
          totalheight += tweetheight[i-1];
      } else {
          $('#tw'+i).css('top', sliderheight);
          $('#tw'+i).animate({'top':0}, slidetime);  
      }
  }
  totalheight += tweetheight[totaltweets];
   
  setInterval(scrolltweets, pausetime);
   
  function scrolltweets() {
      var currentheight = 0;
      //totalheight = 0;
      for (var i=0; i<tweetshift; i++) {
          var nexttweet = currenttweet+i;
          if (nexttweet > totaltweets) {
              nexttweet -= totaltweets;
          }
          currentheight += tweetheight[nexttweet];
      }
       
      for (var i=1; i<=totaltweets; i++) {
          $('#tw'+i).animate({'top': (parseInt($('#tw'+i).css('top'))-currentheight) }, slidetime, function(){
               
              var animatedid = parseInt($(this).attr('id').substr(1,2));
               
              if (animatedid==totaltweets) {
                  for (j=1; j<=totaltweets; j++) {
                      if (parseInt($('#tw'+j).css('top')) < -50) {
                          var toppos = parseInt($('#tw'+lasttweet).css('top')) + tweetheight[lasttweet];
                          $('#tw'+j).css('top', toppos);
                          lasttweet = j;
                           
                          if (currenttweet >= totaltweets) {
                              var newcurrent = currenttweet - totaltweets + 1;
                              currenttweet = newcurrent;
                          } else {
                              currenttweet++;
                          };
                      }
                  }                             
                   
              }
          });                       
      }
   }
}

tweetcarousel();