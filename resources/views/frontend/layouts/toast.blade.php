<style>
.custom-toast-container {
    position: fixed;
    bottom: 30px;
    /* right: 30px; */
    z-index: 9999;
    display: flex
;
    flex-direction: column;
    align-items: flex-end;
    left: 50%;
    transform: translateX(-50%);
}
.custom-toast {
  min-width: 300px;
  max-width: 350px;
  background: #fff;
  color: #222;
  border-radius: 8px;
  box-shadow: 0 4px 16px rgba(0,0,0,0.15);
  border: 1.5px solid #e0e0e0;
  padding: 18px 24px 18px 18px;
  margin-bottom: 12px;
  display: flex;
  align-items: flex-start;
  opacity: 0;
  transform: translateY(30px);
  transition: opacity 0.4s, transform 0.4s;
  font-family: 'Segoe UI', Arial, sans-serif;
  font-size: 1rem;
}
.custom-toast.success {
  border-color: #4caf50;
  box-shadow: 0 4px 16px rgba(76,175,80,0.08);
}
.custom-toast.danger {
  border-color: #f44336;
  box-shadow: 0 4px 16px rgba(244,67,54,0.10);
}
.custom-toast.show {
  opacity: 1;
  transform: translateY(0);
}
.custom-toast .toast-icon {
  font-size: 1.5rem;
  margin-right: 12px;
  color: #4caf50;
}
.custom-toast.danger .toast-icon {
  color: #f44336;
}
.custom-toast.success .toast-icon {
  color: #4caf50;
}
.custom-toast .toast-content {
  flex: 1;
font-size: 1.4rem;
}
.custom-toast .toast-close {
  position: absolute;
    top: 0;
    right: 0;
    background: none;
    border: none;
    color: #888;
    font-size: 1.2rem;
    margin-left: 10px;
    cursor: pointer;
    opacity: 0.7;
    transition: opacity 0.2s;
    width: fit-content;
}
.custom-toast .toast-close:hover {
  opacity: 1;
}
</style>
<div class="custom-toast-container">
  <div id="customToast" class="custom-toast success">
    <span class="toast-icon">&#10003;</span>
    <div class="toast-content">
      <strong>Success!</strong><br>
      Hello, world! This is a custom toast message.
    </div>
    <button class="toast-close" onclick="hideCustomToast()" aria-label="Close">&times;</button>
  </div>
</div>
<script>
function showCustomToast(message = null, type = 'success') {
  const toast = document.getElementById('customToast');
  if (!toast) return;
  // Remove both type classes first
  toast.classList.remove('success', 'danger');
  const icon = toast.querySelector('.toast-icon');
  if (type === 'success') {
    icon.innerHTML = '&#10003;'; // checkmark
    toast.classList.add('success');
    toast.querySelector('.toast-content').innerHTML = message || '<strong>Success!</strong><br>Operation completed successfully.';
  } else {
    icon.innerHTML = '&#10060;'; // cross mark
    toast.classList.add('danger');
    toast.querySelector('.toast-content').innerHTML = message || '<strong>Error!</strong><br>Something went wrong.';
  }
  toast.classList.add('show');
  setTimeout(hideCustomToast, 4000);
}
function hideCustomToast() {
  const toast = document.getElementById('customToast');
  if (toast) toast.classList.remove('show');
}
// Show toast on page load (demo)

 
  // To test danger, use:
  // showCustomToast('<strong>Error!</strong><br>Something went wrong.', 'danger');

</script>
