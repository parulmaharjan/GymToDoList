 
document.getElementById("done-for-today").addEventListener("click", function () {
  // Get the total number of checkboxes
  const totalExercise = document.querySelectorAll('input[name="exercise"]').length;

  // Get the number of checkboxes that are checked
  document.getElementById("selected_day").value = selectedDay;

  const checkboxes = document.querySelectorAll('input[name="exercise"]:checked');
  const doneExercise = checkboxes.length;

  // Set the values of the hidden input fields
  document.getElementById("total_exercise").value = totalExercise;
  document.getElementById("done").value = doneExercise;

  // Submit the form
  document.getElementById("gym-form").submit();
});

