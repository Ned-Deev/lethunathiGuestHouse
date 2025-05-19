// Smooth scroll for navigation links
document.querySelectorAll(".nav-links a").forEach((anchor) => {
  anchor.addEventListener("click", (e) => {
    e.preventDefault();
    const target = document.querySelector(anchor.getAttribute("href"));
    if (target) {
      target.scrollIntoView({ behavior: "smooth" });
    }
  });
});

// Booking form submission
document.getElementById("bookingForm")?.addEventListener("submit", (e) => {
  e.preventDefault();
  const formData = {
    name: document.getElementById("name").value,
    email: document.getElementById("email").value,
    checkin: document.getElementById("checkin").value,
    checkout: document.getElementById("checkout").value,
    room: document.getElementById("room")?.value,
  };

  console.log(
    `Booking Details: Name: ${formData.name}, Email: ${formData.email}, Room: ${formData.room}, Check-in: ${formData.checkin}, Check-out: ${formData.checkout}`
  );
  alert("Your booking request has been submitted!");
});

// Scroll animations for gallery images (debounced for performance)
let scrollTimeout;
const images = document.querySelectorAll(".gallery-images img");

const checkVisibility = () => {
  images.forEach((img) => {
    if (img.getBoundingClientRect().top < window.innerHeight) {
      img.classList.add("visible");
    }
  });
};

window.addEventListener("scroll", () => {
  clearTimeout(scrollTimeout);
  scrollTimeout = setTimeout(checkVisibility, 100);
});
checkVisibility(); // Initial check

// Hide preloader on window load
window.addEventListener("load", () => {
  document.body.classList.add("loaded");
});

// Datepicker validation and behavior
document.addEventListener("DOMContentLoaded", () => {
  const checkin = document.getElementById("checkin");
  const checkout = document.getElementById("checkout");
  const today = new Date().toISOString().split("T")[0];

  checkin.setAttribute("min", today);
  checkout.setAttribute("min", today);

  // Update checkout date based on checkin
  checkin.addEventListener("change", () => {
    const selectedDate = new Date(checkin.value);
    if (!isNaN(selectedDate.getTime())) {
      const nextDay = new Date(selectedDate);
      nextDay.setDate(selectedDate.getDate() + 1);
      checkout.value = nextDay.toISOString().split("T")[0];
      checkout.setAttribute("min", checkin.value);
    }
  });

  const bookedDates = ["2025-05-21", "2025-05-22", "2025-05-25", "2025-06-01"];

  // Disable booked dates and prevent past dates
  [checkin, checkout].forEach((input) => {
    input.addEventListener("input", () => {
      const selected = input.value;
      if (bookedDates.includes(selected)) {
        alert("Sorry, this date is already booked. Please choose another.");
        input.value = "";
      }
    });

    input.addEventListener("keydown", (e) => e.preventDefault());
  });
});

// Lightbox functionality for gallery images (create lightbox once)
const galleryItems = document.querySelectorAll(".gallery-item a");
let lightbox = null;

const createLightbox = () => {
  if (lightbox) return lightbox; // Return existing lightbox
  lightbox = document.createElement("div");
  lightbox.classList.add("lightbox");
  document.body.appendChild(lightbox);

  const lightboxImage = document.createElement("img");
  lightbox.appendChild(lightboxImage);

  const closeButton = document.createElement("span");
  closeButton.textContent = "×";
  closeButton.classList.add("close");
  lightbox.appendChild(closeButton);

  const nextButton = document.createElement("button");
  nextButton.classList.add("next");
  nextButton.textContent = "▶";
  lightbox.appendChild(nextButton);

  const prevButton = document.createElement("button");
  prevButton.classList.add("prev");
  prevButton.textContent = "◀";
  lightbox.appendChild(prevButton);

  // Close lightbox
  closeButton.addEventListener("click", () => {
    lightbox.style.display = "none";
  });

  // Navigate through images in lightbox
  nextButton.addEventListener("click", () => showImage(1));
  prevButton.addEventListener("click", () => showImage(-1));

  return lightbox;
};

// Open lightbox on image click
let currentImageIndex = 0;
galleryItems.forEach((item, index) => {
  item.addEventListener("click", (event) => {
    event.preventDefault();
    currentImageIndex = index;
    const imgSrc = item.getAttribute("href");
    const lightbox = createLightbox();
    lightbox.querySelector("img").src = imgSrc;
    lightbox.style.display = "flex";
  });
});

// Show next/previous image
function showImage(offset) {
  currentImageIndex =
    (currentImageIndex + offset + galleryItems.length) % galleryItems.length;
  lightbox.querySelector("img").src =
    galleryItems[currentImageIndex].getAttribute("href");
}

// VanillaTilt for hero section
VanillaTilt.init(document.querySelector(".hero"), {
  max: 2,
  speed: 400,
  glare: false,
});

// Scroll to the map section
function scrollToMap() {
  document.querySelector("#map").scrollIntoView({ behavior: "smooth" });
}

// Initialize and display the Google Map
function initMap() {
  const location = { lat: -26.279617, lng: 27.899314 };
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 15,
    center: location,
    styles: getMapStyles(),
  });

  new google.maps.Marker({
    position: location,
    map: map,
    title: "10927 Mokoena St, Dobsonville",
    icon: {
      url: "https://maps.google.com/mapfiles/ms/icons/blue-dot.png",
      scaledSize: new google.maps.Size(30, 30),
    },
  });

  setTimeout(() => document.body.classList.add("map-visible"), 500);
}

window.addEventListener("load", initMap);

// Open the address in Google Maps
function viewInGoogleMaps() {
  document.querySelector("#map").scrollIntoView({ behavior: "smooth" });
  const address = "10927+Mokoena+St,+Dobsonville,+Soweto,+1863";
  window.open(`https://www.google.com/maps?q=${address}`, "_blank");
}

// Helper Functions for Map Styles
function getMapStyles() {
  return [
    { elementType: "geometry", stylers: [{ color: "#212121" }] },
    { elementType: "labels.icon", stylers: [{ visibility: "off" }] },
    { elementType: "labels.text.fill", stylers: [{ color: "#757575" }] },
    { elementType: "labels.text.stroke", stylers: [{ color: "#212121" }] },
    {
      featureType: "road",
      elementType: "geometry",
      stylers: [{ color: "#212121" }],
    },
    {
      featureType: "road.highway",
      elementType: "geometry",
      stylers: [{ color: "#3e3e3e" }],
    },
    {
      featureType: "water",
      elementType: "geometry",
      stylers: [{ color: "#000000" }],
    },
    {
      featureType: "water",
      elementType: "labels.text.fill",
      stylers: [{ color: "#3d3d3d" }],
    },
  ];
}
