function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    sidebar.classList.toggle("sidebar-open");
}

// Calorie burn calculator function
function calculateCalories() {
    const duration = document.getElementById("duration").value;
    const intensity = document.getElementById("intensity").value;
    const result = document.getElementById("result");

    if (duration && intensity) {
        const caloriesBurned = duration * intensity * 0.1; // Basic formula
        result.innerText = `You burned approximately ${caloriesBurned.toFixed(2)} calories.`;
        result.style.color = "green";

    } else {
        result.innerText = "Please enter valid duration and intensity.";
        result.style.color = "red";
    }
}
window.onload = function() {
    const formSubmitted = "<?php echo $form_submitted; ?>";
    if (formSubmitted === "1") {
        alert("Thank you for your inquiry! We will get back to you soon.");
    }
};
