(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "http://connect.facebook.net/en_GB/all.js#xfbml=1&appId=815724718444105";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


jQuery(document).ready(function($){
  $('#social-stream').dcSocialStream({
    feeds: {
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
      instagram: {
        id: '492866873',
        accessToken: '1131422920.391f7a6.3226857c319c431ead35918658726849',
        redirectUrl: 'http://prueba.heimdaldesign.com/TuVotaX/',
        clientId: '391f7a62e0d3453aabafe7e0414b72b5',
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