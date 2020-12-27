$(document).ready(function(){
    const nav = $("body > nav");

    let i = 0;

    nav.hide();

    $("body > header > p").click(function(){
       console.log("ciao ciccio!");
       if(i == 0){
          nav.slideDown();
          i = 1;
      } else {
          nav.slideUp();
          i = 0;
      }
    });
});
