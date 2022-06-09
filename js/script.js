function menu(){
    document.getElementById('menu').style.display = 'block';
    document.getElementById('showcase').style.display = 'none';
}
function cerrar(){
    document.getElementById('showcase').style.display = 'flex';
    document.getElementById('menu').style.display = 'none';
}
$(document).ready(function() {
    ScrollToInit();
    ActiveSectionNavigation();
    InitWaypointAnimations({
        offset: "60%",
        animateClass: "wp-animated",
        animateGroupClass: "wp-animated-group"
    });
    InitCounterWayPointAnimation();
  });
  
  function ScrollToInit() {
    $(document).on("click", "a[href^='#']", function(event) {
        var $anchor = $(this);
        $("html, body").stop().animate({
            scrollTop: $($anchor.attr("href")).offset().top
        }, 1500, "easeInOutExpo");
        event.preventDefault();
    });
  }
  
  function ActiveSectionNavigation() {
    function getNavItemsMap() {
        const navItemsMap = $("#main-nav").find(".nav-item").map((index, item) => {
            const $item = $(item);
            const name = $item.find(".nav-link").attr("href").substring(1);
            return {
                key: name,
                val: $item
            };
        })
        .toArray()
        .reduce((map, obj) => {
            map[obj.key] = obj.val;
            return map;
        }, {});
  
        return navItemsMap;
    }
  
    function deactivateCurrentNavItem() {
        $("#main-nav").find(".nav-item.active").removeClass("active");
    }
    
    const navItemsMap = getNavItemsMap();
    $("section").each((index, element) => {
        const $element = $(element);
        const sectionName = $element.attr("id");
        if(sectionName in navItemsMap) {
            
            $element.waypoint((direction) => {
                if(direction === "down") {
                    deactivateCurrentNavItem();
                    navItemsMap[sectionName].addClass("active");
                }
            },{
                offset: "50%"
            });
            
            $element.waypoint((direction) => {
                if(direction === "up") {
                    deactivateCurrentNavItem();
                    navItemsMap[sectionName].addClass("active");
                }
            },{
                offset: "-20%"
            })
        }
    });
  }
  
  function InitCounterWayPointAnimation() {
    $('.counter').each(function () {
        var $this = $(this);
        var stop = parseInt($this.text().replace(/,/g, ""));
        $this.text(0);
        $this.waypoint(function (direction) {
            animateNumbers($this, 0, stop);
            this.destroy();
        },{
            triggerOnce: true,
            offset: "80%"
        });
    });  
  }
  
  function animateNumbers(element, start, stop, commas, duration, ease) {
    var $this = element;
    commas = (commas === undefined) ? true : commas;
    $({value: start}).animate({value: stop}, {
        duration: duration == undefined ? 4000 : duration,
        easing: ease == undefined ? "swing" : ease,
        step: function() {
            $this.text(Math.floor(this.value));
            if (commas) { $this.text($this.text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")); }
        },
        complete: function() {
           if (parseInt($this.text()) !== stop) {
               $this.text(stop);
               if (commas) { $this.text($this.text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")); }
           }
        }
    });
  }
  /*APLICACIONES */


  function magenta(){
    document.getElementById('magenta').style.display = 'block';
    document.getElementById('F-magenta').style.display = 'block';
    document.getElementById('azul').style.display = 'none';
    document.getElementById('F-azul').style.display = 'none';
    document.getElementById('amarillo').style.display = 'none';
    document.getElementById('F-amarilla').style.display = 'none';
    document.getElementById('verde').style.display = 'none';
    document.getElementById('F-verde').style.display = 'block';
  }
  function azul(){
    document.getElementById('azul').style.display = 'block';
    document.getElementById('F-azul').style.display = 'block';
    document.getElementById('magenta').style.display = 'none';
    document.getElementById('F-magenta').style.display = 'none';
    document.getElementById('amarillo').style.display = 'none';
    document.getElementById('F-amarilla').style.display = 'none';
    document.getElementById('verde').style.display = 'none';
  }
  function amarillo(){
    document.getElementById('amarillo').style.display = 'block';
    document.getElementById('F-amarilla').style.display = 'block';
    document.getElementById('magenta').style.display = 'none';
    document.getElementById('F-magenta').style.display = 'none';
    document.getElementById('azul').style.display = 'none';
    document.getElementById('F-azul').style.display = 'none';
    document.getElementById('verde').style.display = 'none';
    document.getElementById('F-verde').style.display = 'none';
  }
  function verde(){
    document.getElementById('verde').style.display = 'block';
    document.getElementById('F-verde').style.display = 'block';
    document.getElementById('magenta').style.display = 'none';
    document.getElementById('F-magenta').style.display = 'none';
    document.getElementById('amarillo').style.display = 'none';
    document.getElementById('F-amarilla').style.display = 'none';
    document.getElementById('azul').style.display = 'none';
    document.getElementById('F-azul').style.display = 'none';

  }

  /*IMÁGENES QUE ENTRAN POR UN LADO */
  function reveal() {
    var reveals = document.querySelectorAll(".reveal");
  
    for (var i = 0; i < reveals.length; i++) {
      var windowHeight = window.innerHeight;
      var elementTop = reveals[i].getBoundingClientRect().top;
      var elementVisible = 150;
  
      if (elementTop < windowHeight - elementVisible) {
        reveals[i].classList.add("active");
      } else {
        reveals[i].classList.remove("active");
      }
    }
  }
  
  window.addEventListener("scroll", reveal);
  /*TERMINA IMÁGENES QUE ENTRAN POR UN LADO */

  /* CAPTCHA */
  $('#form').submit(function (event) {
    event.preventDefault();
    grecaptcha.ready(function () {
        grecaptcha.execute('6LdlllUgAAAAAPMPHUfbRrqTZ_ko7ceOt77c_dKr', { action: 'registro' }).then(function (token) {
            $('#form').prepend('<input type="hidden" name="token" value="' + token + '">');
            $('#form').prepend('<input type="hidden" name="action" value="registro">');
            $('#form').unbind('submit').submit();
        });
    });
});