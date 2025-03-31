document.addEventListener('DOMContentLoaded', function () {
    const bookingButton = document.querySelector('.wc-bookings-booking-form-button.single_add_to_cart_button');
    if (bookingButton) {
        bookingButton.textContent = 'Proceed to Confirm Booking';
    }
});
