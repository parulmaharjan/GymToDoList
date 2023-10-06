document.getElementById("generate").addEventListener("click", function () {
  // Show the exercise container when the "Generate" button is clicked
  document.querySelector(".exercise-container").style.display = "block";
  // Generate exercise checkboxes here (you may use AJAX for this)
});

document.getElementById("done-for-today").addEventListener("click", function () {
  // Get data from the checkboxes
  const checkboxes = document.querySelectorAll('input[name="exercise"]:checked');
  const allTotal = document.querySelectorAll('input[name="exercise"]')
  const totalExercise = allTotal.length;
  const selectedDay = document.getElementById("day-select").value;

  // Set the values of the hidden input fields
  document.getElementById("selected_day").value = selectedDay;
  document.getElementById("total_exercise").value = totalExercise;

  // Submit the form
  document.getElementById("gym-form").submit();
});