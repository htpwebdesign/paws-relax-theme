// Event Listener for Team Member "More Info" Button

document.addEventListener("DOMContentLoaded", function () {

    const buttons = document.querySelectorAll(".more-info-button");

  

    buttons.forEach(function (button) {

      button.addEventListener("click", function () {

        const postId = button.getAttribute("data-id");

        const teamMemberName = button.getAttribute("data-name");

  

        // Fetch both ACF data and testimonials, then show modal

        Promise.all([fetchACFData(postId), fetchTestimonialsData(teamMemberName)])

          .then(([teamDetails, testimonials]) => {

            showModal(teamDetails, testimonials);

          })

          .catch((error) => console.error("Error fetching data:", error));

      });

    });

  });

  

  // Fetch ACF data function

  function fetchACFData(postId) {

    return fetch(myAjax.ajaxurl, {

      method: "POST",

      headers: { "Content-Type": "application/x-www-form-urlencoded" },

      body: new URLSearchParams({

        action: "fetch_team_member_details",

        post_id: postId,

      }),

    })

      .then((response) => response.json())

      .then((data) => {

        if (data.success) {

          return data.data; // Return the fetched HTML content

        } else {

          console.error("Failed to fetch ACF data:", data.data);

          return "";

        }

      })

      .catch((error) => {

        console.error("AJAX error:", error);

        return "";

      });

  }

  

  // Fetch testimonials data function

  function fetchTestimonialsData(teamMemberName) {

    return fetch(myAjax.ajaxurl, {

      method: "POST",

      headers: { "Content-Type": "application/x-www-form-urlencoded" },

      body: new URLSearchParams({

        action: "get_testimonials",

        team_member: teamMemberName,

      }),

    })

      .then((response) => response.json())

      .then((data) => {

        if (data.success) {

          return data.data; // Return testimonials array

        } else {

          console.error("Failed to fetch testimonials:", data.data);

          return [];

        }

      })

      .catch((error) => {

        console.error("AJAX error:", error);

        return [];

      });

  }

  // Show Modal with Team Details and Testimonials

  function showModal(content, testimonials) {

    // Create the modal container dynamically

    let modal = document.createElement("div");

    modal.id = "team-modal";

    modal.style.cssText = `

          position: fixed; 

          top: 0; 

          left: 0; 

          width: 100%; 

          height: 100%; 

          background-color: rgba(0, 0, 0, 0.8); 

          display: flex; 

          justify-content: center; 

          align-items: center; 

          z-index: 1000;

      `;

  

    // Create the modal content container

    let modalContent = document.createElement("div");

    modalContent.className = "modal-content";

    modalContent.style.cssText = `

          background: #fff; 

          padding: 20px; 

          border-radius: 5px; 

          max-width: 1000px; 

          width: 100%; 

          box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);

      `;

    modalContent.innerHTML = content;

  

    // Add Testimonials below the content

    if (testimonials.length > 0) {

      let testimonialsHTML = "";

      testimonials.forEach((testimonial) => {

        testimonialsHTML += `

          <div class="testimonial">

            <p>${testimonial.content}</p>

          </div>

        `;

      });

  

      let testimonialsSection = document.createElement("div");

      testimonialsSection.className = "testimonials-section";

      testimonialsSection.innerHTML = testimonialsHTML;

      modalContent.appendChild(testimonialsSection);

    }

  

    // Create the close button

    let closeButton = document.createElement("button");

    closeButton.className = "modal-close";

    closeButton.textContent = "Close";

    closeButton.style.cssText = `

        margin-top: 10px; 
        background: #ffffff; 
        color: #CB7A5C; 
        border: solid 2px #CB7A5C; 
        padding: 10px 20px; 
        cursor: pointer; 
        border-radius: 5px;

      `;

  

    // Add close functionality

    closeButton.addEventListener("click", function () {

      modal.remove(); // Remove the modal from the DOM

    });

  

    // Append everything to the modal

    modalContent.appendChild(closeButton);

    modal.appendChild(modalContent);

    document.body.appendChild(modal);

  }


