  </main>
</div><!-- /.main-content -->
</div><!-- /.app-layout -->

<script>
function toggleSidebar(){
  document.getElementById('sidebar').classList.toggle('open');
  document.getElementById('sidebarOverlay').style.display =
    document.getElementById('sidebar').classList.contains('open') ? 'block' : 'none';
}
function closeSidebar(){
  document.getElementById('sidebar').classList.remove('open');
  document.getElementById('sidebarOverlay').style.display = 'none';
}
// Active nav link
(function(){
  const path = window.location.pathname;
  document.querySelectorAll('.sidebar-nav a').forEach(a => {
    if(path.startsWith(a.getAttribute('href'))) {
      a.classList.add('active');
      // If inside a dropdown, open it
      const parentDropdown = a.closest('.sidebar-dropdown');
      if(parentDropdown) parentDropdown.classList.add('active');
    }
  });
})();

function toggleDropdown(el) {
  el.closest('.sidebar-dropdown').classList.toggle('active');
}

function openModal(id) {
  document.getElementById(id).classList.add('open');
}

function closeModal(id) {
  document.getElementById(id).classList.remove('open');
}

// Close modal on click outside
window.onclick = function(event) {
  if (event.target.classList.contains('modal')) {
    event.target.classList.remove('open');
  }
}
</script>
</body>
</html>
