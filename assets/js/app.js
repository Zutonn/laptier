(function(){
  const navToggle=document.querySelector('.nav-toggle');
  const nav=document.querySelector('.main-nav');
  if(navToggle&&nav){navToggle.addEventListener('click',()=>{const open=nav.classList.toggle('is-open');navToggle.setAttribute('aria-expanded',open?'true':'false');navToggle.textContent=open?'×':'☰';});}
  const KEY='laptier_compare_v1';
  const readIds=()=>{try{return [...new Set((JSON.parse(localStorage.getItem(KEY)||'[]')).map(Number).filter(n=>Number.isInteger(n)&&n>0))].slice(0,4);}catch(e){return[];}};
  const writeIds=(ids)=>{localStorage.setItem(KEY,JSON.stringify(ids.slice(0,4)));updateCompareUI();};
  function updateCompareUI(){const ids=readIds();document.querySelectorAll('.compare-count').forEach(el=>el.textContent=String(ids.length));document.querySelectorAll('.compare-link').forEach(el=>{const base=new URL('bandingkan.php',window.location.href);if(ids.length)base.searchParams.set('ids',ids.join(','));else base.searchParams.delete('ids');el.href=base.toString();});document.querySelectorAll('.compare-toggle').forEach(btn=>{const is=ids.includes(Number(btn.dataset.productId));btn.classList.toggle('is-selected',is);btn.setAttribute('aria-pressed',is?'true':'false');btn.textContent=is?'✓ Dipilih':'+ Bandingkan';});}
  document.querySelectorAll('.compare-toggle').forEach(btn=>btn.addEventListener('click',()=>{const id=Number(btn.dataset.productId);let ids=readIds();if(ids.includes(id)){ids=ids.filter(n=>n!==id);}else{if(ids.length>=4){alert('Maksimal 4 laptop untuk dibandingkan. Hapus satu pilihan terlebih dahulu.');return;}ids.push(id);}writeIds(ids);}));
  updateCompareUI();
  const deleteForms=document.querySelectorAll('[data-confirm]');deleteForms.forEach(form=>form.addEventListener('submit',e=>{if(!confirm(form.dataset.confirm||'Lanjutkan tindakan ini?'))e.preventDefault();}));
})();
