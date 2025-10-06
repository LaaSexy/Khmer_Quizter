// Activity Page JavaScript
document.addEventListener("DOMContentLoaded", function () {
  // Initialize page functionality
  initActivityPage();

  // Add event listeners
  setupEventListeners();
});

function initActivityPage() {
  // Add loading animation to cards
  const cards = document.querySelectorAll(".ccc");

  // Check if we have activity cards or empty state
  if (cards.length > 0) {
    // We have activity cards
    console.log(`Loaded ${cards.length} activity cards`);

    // Add click handlers to cards
    cards.forEach((card) => {
      card.addEventListener("click", function () {
        // Add visual feedback when card is clicked
        this.style.transform = "scale(0.98)";
        setTimeout(() => {
          this.style.transform = "";
        }, 150);

        // In a real implementation, this would navigate to quiz details
        console.log("Card clicked - would navigate to quiz details");
      });
    });
  } else {
    // We're showing the empty state
    console.log("No activity found - showing empty state");

    // Add animation to empty state elements
    const emptyState = document.querySelector(".empty-activity");
    if (emptyState) {
      emptyState.style.opacity = "0";
      emptyState.style.transform = "translateY(20px)";

      setTimeout(() => {
        emptyState.style.transition = "opacity 0.5s ease, transform 0.5s ease";
        emptyState.style.opacity = "1";
        emptyState.style.transform = "translateY(0)";
      }, 300);
    }
  }
}

function setupEventListeners() {
  // Add hover effects for the play now button
  const playNowBtn = document.querySelector(".play-now-btn");
  if (playNowBtn) {
    playNowBtn.addEventListener("mouseenter", function () {
      this.style.transform = "translateY(-3px)";
    });

    playNowBtn.addEventListener("mouseleave", function () {
      this.style.transform = "translateY(0)";
    });
  }

  // Handle window resize for responsive adjustments
  window.addEventListener(
    "resize",
    debounce(function () {
      adjustCardLayout();
    }, 250)
  );
}

function adjustCardLayout() {
  // Adjust card layout based on screen size
  const cards = document.querySelectorAll(".card");
  const screenWidth = window.innerWidth;

  if (screenWidth < 768) {
    // Mobile layout adjustments
    cards.forEach((card) => {
      card.style.marginBottom = "20px";
    });
  } else {
    // Reset for larger screens
    cards.forEach((card) => {
      card.style.marginBottom = "";
    });
  }
}

// Utility function to debounce resize events
function debounce(func, wait) {
  let timeout;
  return function executedFunction(...args) {
    const later = () => {
      clearTimeout(timeout);
      func(...args);
    };
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
  };
}

// Function to refresh activity data (could be used with AJAX)
function refreshActivityData() {
  console.log("Refreshing activity data...");
  // In a real implementation, this would make an AJAX request
  // to get updated activity data from the server
}

// Export functions for potential use in other modules
if (typeof module !== "undefined" && module.exports) {
  module.exports = {
    initActivityPage,
    refreshActivityData,
  };
}
