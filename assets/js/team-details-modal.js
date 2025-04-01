// Event Listener for Team Member "More Info" Button
document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".more-info-button");

    buttons.forEach(function (button) {
        button.addEventListener("click", function () {
            const postId = button.getAttribute("data-id");

            // Fetch ACF data via AJAX
            fetchACFData(postId);
        });
    });
});

// Fetch ACF data function
function fetchACFData(postId) {
    fetch(myAjax.ajaxurl, {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams({
            action: "fetch_team_member_details", // WordPress AJAX action name
            post_id: postId, // The post ID to fetch data for
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                showModal(data.data); // Pass the fetched HTML to the modal
            } else {
                console.error("Failed to fetch ACF data:", data.data);
            }
        })
        .catch((error) => {
            console.error("AJAX error:", error);
        });
}

// Show Modal with Team Details
function showModal(content) {
    // Create the modal container dynamically
    let modal = document.createElement('div');
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
    let modalContent = document.createElement('div');
    modalContent.className = "modal-content";
    modalContent.style.cssText = `
        background: #fff; 
        padding: 20px; 
        border-radius: 5px; 
        max-width: 600px; 
        width: 100%; 
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    `;
    modalContent.innerHTML = content;

    // Create the close button
    let closeButton = document.createElement('button');
    closeButton.className = "modal-close";
    closeButton.textContent = "Close";
    closeButton.style.cssText = `
        margin-top: 10px; 
        background: #CB7A5C; 
        color: #fff; 
        border: none; 
        padding: 10px 20px; 
        cursor: pointer; 
        border-radius: 5px;
    `;

    // Add close functionality
    closeButton.addEventListener('click', function () {
        modal.remove(); // Remove the modal from the DOM
    });

    // Append everything to the modal
    modalContent.appendChild(closeButton);
    modal.appendChild(modalContent);

    // Append the modal to the body
    document.body.appendChild(modal);
}
