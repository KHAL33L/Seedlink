document.addEventListener("DOMContentLoaded", () => {
    const seedsBtn = document.getElementById("seeds-btn");
    const saplingsBtn = document.getElementById("saplings-btn");
    const seedsCard = document.getElementById("seeds-card");
    const saplingsCard = document.getElementById("saplings-card");
    const slider = document.getElementById("filter-slider");
    const sliderValue = document.getElementById("sliderValue");

    // Slider value display
    slider.addEventListener("input", () => {
        sliderValue.textContent = slider.value;
    });

    // Show Seeds Card
    seedsBtn.addEventListener("click", () => {
        seedsCard.classList.add("active");
        saplingsCard.classList.remove("active");
    });

    // Show Saplings Card
    saplingsBtn.addEventListener("click", () => {
        saplingsCard.classList.add("active");
        seedsCard.classList.remove("active");
    });
});
