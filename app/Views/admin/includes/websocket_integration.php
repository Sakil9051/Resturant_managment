<!-- Include this in your admin layout header or individual pages -->
<script src="<?= base_url('js/notifications.js') ?>"></script>

<script>
// Notifications load automatically on page load
// Refresh every 30 seconds to check for new notifications

document.addEventListener('DOMContentLoaded', function() {
    console.log('Notification system initialized');
    console.log('Notifications will refresh every 30 seconds');
});
</script>
