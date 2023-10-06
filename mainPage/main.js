 
  document.getElementById("generate").addEventListener("click", function () {
    // Show the exercise container
    document.querySelector(".exercise-container").style.display = "block";
  });
  
  document.querySelector(".exercise-container button").addEventListener("click", function () {
    // Get data from the checkboxes
    const checkboxes = document.querySelectorAll('input[name="exercise"]:checked');
    const totalExercise = checkboxes.length;
    const selectedDay = document.getElementById("day-select").value;
  
    // Set the values of the hidden input fields
    document.querySelector("input[name='selected_day']").value = selectedDay;
    document.querySelector("input[name='total_exercise']").value = totalExercise;
  
    // Submit the form
    document.getElementById("gym-form").submit();
  });
  