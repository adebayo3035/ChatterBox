// session_timeout.js
// const inactivityTimeout = 0.5 * 60 * 1000; // 15 minutes in milliseconds
// let inactivityTimer;
// var userId = <?php echo isset($_SESSION['unique_id']) ? $_SESSION['unique_id'] : 'null'; ?>;

// function resetInactivityTimer(userId) {
//     clearTimeout(inactivityTimer);
//     inactivityTimer = setTimeout(function () {
//         // Redirect to logout page or trigger a logout function
//         window.location.href = 'php/logout.php?logout_id=' + userId;
//     }, inactivityTimeout);
// }

// // document.addEventListener('mousemove', resetInactivityTimer);
// // document.addEventListener('keydown', resetInactivityTimer);

// // Call resetInactivityTimer with the user ID
// resetInactivityTimer(userId);

// document.addEventListener('mousemove', function () {
//     resetInactivityTimer(userId);
// });

// document.addEventListener('keydown', function () {
//     resetInactivityTimer(userId);
// });
