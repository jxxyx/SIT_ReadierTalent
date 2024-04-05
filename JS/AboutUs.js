let slider = tns({
    container: ".my-slider",
    slideBy: "1",
    speed: 400,
    nav: false,
    autoplay: true,
    controls: false,
    autoplayButtonOutput: false,
    responsive: {
      1600: {
        items: 3,
        gutter: 20
      },
      1024: {
        items: 3,
        gutter: 20
      },
      768: {
        items: 2,
        gutter: 20
      },
      480: {
        items: 1,
        gutter: 20
      }
    }
  });

  document.addEventListener('DOMContentLoaded', (event) => {
    // Select all buttons with the 'button' class
    const contactButtons = document.querySelectorAll('.button[data-email]');

    // Add click event listener to each button
    contactButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Retrieve the email address from the data-email attribute
            const emailAddress = this.getAttribute('data-email');

            // Use window.location to navigate to the mailto link
            window.location.href = `mailto:${emailAddress}`;
        });
    });
});