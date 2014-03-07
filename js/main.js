(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "http://connect.facebook.net/en_GB/all.js#xfbml=1&appId=815724718444105";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

jQuery(document).ready(function($){

  jwplayer("container").setup({
      backcolor: "000000",
    frontcolor: "FFFFFF",
    lightcolor: "FFFFFF",
    screencolor: "000000",
    image: 'http://tvx.com.sv/img/1.jpg',
    volume: 100,
    aspectratio: "12:5",
    autostart: "true",
    controlbar: "over",
        width: '100%',
        modes: [
            { type: "flash", 
              src: "http://source.netandino.com/html5/player-2012-free.swf", 
              config: {
                file: "canal23",
                streamer: "rtmp://panel.elsalvadordigital.com/canal23",
                provider: "rtmp"
              }
            },
            { type: "html5",
              config: {
                file: "http://panel.elsalvadordigital.com:1935/canal23/canal23/playlist.m3u8"
              }
            },
            { type: "download" }
        ]

    });

    function createPhotoElement(photo) {
      var innerHtml = $('<img>')
        .addClass('instagram-image')
        .attr('src', photo.images.thumbnail.url);

      innerHtml = $('<a>')
        .attr('target', '_blank')
        .attr('href', photo.link)
        .append(innerHtml);

      return $('<div>')
        .addClass('col-xs-3')
        .attr('id', photo.id)
        .append(innerHtml);
    }

    function didLoadInstagram(event, response) {
      var that = this;

      $.each(response.data, function(i, photo) {
        $(that).append(createPhotoElement(photo));
      });
    }

    $(document).ready(function() {
      var clientId = '391f7a62e0d3453aabafe7e0414b72b5';
      
      $('.instagram.tag').on('didLoadInstagram', didLoadInstagram);
      $('.instagram.tag').instagram({
        hash: 'elecciones2014',
        count: 16,
        clientId: clientId
      });
      
    });
  
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
  
  updateShows();
  setInterval(updateShows,60000);
});

function updateShows(){
  $.getJSON(
      'getShows.php',
      function(response) {
        var texto = response.actual.nombre + " - " + response.actual.invitados;
        $('#prog-actual h1').text(texto);
        $('#prog-actual p').text("Hora: " + response.actual.inicio + " - " + response.actual.fin);
        texto = response.siguiente.nombre + " - " + response.siguiente.invitados;
        $('#prog-mas h1').text(texto);
        $('#prog-mas p').text("Hora: " + response.siguiente.inicio + " - " + response.siguiente.fin);
      }
    )
}

$('#gifSlider').bxSlider({
  mode: 'fade',
  responsive: true,
  auto: true,
  pause: 5000,
  autoControls: true,
});

$('.pub-tvx-programas').bxSlider({
  mode: 'fade',
  responsive: true,
  auto: true,
  pause: 20000,
  autoControls: true,
});

$.getJSON('getstatistics.php', function(response){
    // console.log(response);
});


    



