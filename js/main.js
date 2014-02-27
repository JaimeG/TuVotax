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

jwplayer('playersrXcjcduSWEp').setup({
    file: 'rtmp://panel.elsalvadordigital.com/canal23,canal23',
    image: 'https://www.longtailvideo.com/content/images/jw-player/lWMJeVvV-876.jpg',
    width: '100%',
    aspectratio: '16:9'
});