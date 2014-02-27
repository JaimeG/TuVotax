window.fbAsyncInit = function() {
  FB.init({
    appId      : '815724718444105',
    status     : true,
    xfbml      : true
  });
};


(function(d, s, id){
   var js, fjs = d.getElementsByTagName(s)[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement(s); js.id = id;
   js.src = "http://connect.facebook.net/en_US/all.js";
   fjs.parentNode.insertBefore(js, fjs);
 }(document, 'script', 'facebook-jssdk'));


jQuery(document).ready(function($){
  $('#social-stream').dcSocialStream({
    feeds: {
      twitter: {
        id: '/9927875,#designchemical,designchemical'
      },
      facebook: {
        id: '297691763653926, 171905043005822',
        intro: 'Posted',
        out: 'intro,thumb,text,user,share',
        text: 'content'
      },
      youtube: {
        id: 'canaltvx',
        thumb: '0'
      },
      pinterest: {
        id: 'canaltvx'
      },
    },
    rotate: {
      delay: 0
    },
    twitterId: 'canaltvx',
    control: false,
    filter: false,
    wall: true,
    order: 'random',
    cache: false,
    max: 'limit',
    limit: 10,
    iconPath: 'img/dcsns-dark/',
    imagePath: 'img/dcsns-dark/'
  });
         
});

jwplayer('playersrXcjcduSWEp').setup({
    file: 'rtmp://panel.elsalvadordigital.com/canal23,canal23',
    image: 'https://www.longtailvideo.com/content/images/jw-player/lWMJeVvV-876.jpg',
    width: '100%',
    aspectratio: '16:9'
});