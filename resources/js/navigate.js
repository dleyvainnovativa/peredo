document.querySelectorAll('[data-next],[data-prev]').forEach(btn => {
  btn.addEventListener('click', e => {
    const targetId = btn.dataset.next || btn.dataset.prev;
    // console.log(targetId);
    const triggerEl = document.getElementById(targetId);
    // console.log(triggerEl);
    const tab = new bootstrap.Tab(triggerEl);
    // console.log(tab);
    tab.show();
window.scrollTo(0, 0);

  });
});