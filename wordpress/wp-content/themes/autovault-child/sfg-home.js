(function(){
  var obs=new IntersectionObserver(function(es){
    es.forEach(function(e){if(e.isIntersecting){e.target.classList.add('in');obs.unobserve(e.target);}});
  },{threshold:.1,rootMargin:'0px 0px -24px 0px'});
  document.querySelectorAll('.sfg-page .rv').forEach(function(el){obs.observe(el);});
  document.querySelectorAll('.sfg-page a[href^="#"]').forEach(function(a){
    a.addEventListener('click',function(e){
      var t=document.querySelector(a.getAttribute('href'));
      if(t){e.preventDefault();t.scrollIntoView({behavior:'smooth'});}
    });
  });
})();
