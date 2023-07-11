$(document).ready(function() {
    var max_video_fields      = 50; //maximum input boxes allowed
    var video_wrapper       = $(".input_fields_wrap_video"); //Fields wrapper
    var add_video_button      = $(".add_field_button_video"); //Add button ID
    // var numOfVid = document.getElementById('vCount').value;

    var x = 0; //initlal text box count
    var v=0;
    $(add_video_button).click(function(e){ //on add input button click
      e.preventDefault();
        if(x < max_video_fields){ //max input box allowed
            x++; //text box increment

            $(video_wrapper).append('<div class="mt-3"><div class="form-row"><div class="form-group col-md-8"><hr style="height:2px;background-color:black"><br><label for="inputPassword">Upload New Video '+(x+1)+' </label><input type="file" class="form-control-file" accept="video/*"  id="inputProfile" name="course_video[]"></div></div><div class="form-row"><div class="form-group col-md-8"><label for="inputName">Video Title</label><input type="text" class="form-control" id="inputName" name="video_title[]" placeholder="Video Title"></div></div><div class="form-row"><div class="form-group col-md-8"><label for="description">Video Description</label><textarea class="form-control" id="course_description" name="video_description[]" rows="3" ></textarea></div></div><div class="form-row"><div class="form-group col-md-8"><label for="inputPassword">Upload Video Thumbnile</label><div class="input_fields_wrap"><input type="file" class="form-control-file"  id="inputProfile" accept="image/*" name="video_thumb[]"  style="margin-bottom: 15px;" multiple=""></div></div></div><div class="form-row"><div class="form-group col-md-8"><label for="inputPassword">Upload Documents</label><div class="input_fields_wrap"><input type="file" class="form-control-file" name="video_document'+x+'[]"  id="inputProfile" style="margin-bottom: 15px;" multiple=""></div></div></div><div class="input-group-append"><button class="btn btn-outline-danger remove_video_field" type="button">Remove</button></div><br></div>'); //add new form
            v++;
           
        }
    });

    $(video_wrapper).on("click",".remove_video_field", function(e){ //user click on remove text
        e.preventDefault(); 
        $(this).parent('div').parent('div').remove();
        x--;
    })
  });





       /**
         * Define a function to navigate betweens form steps.
         * It accepts one parameter. That is - step number.
         */
        const navigateToFormStep = (stepNumber) => {
            /**
             * Hide all form steps.
             */
            document.querySelectorAll(".form-step").forEach((formStepElement) => {
                formStepElement.classList.add("d-none");
            });
            /**
             * Mark all form steps as unfinished.
             */
            document.querySelectorAll(".form-stepper-list").forEach((formStepHeader) => {
                formStepHeader.classList.add("form-stepper-unfinished");
                formStepHeader.classList.remove("form-stepper-active", "form-stepper-completed");
            });
            /**
             * Show the current form step (as passed to the function).
             */
            document.querySelector("#step-" + stepNumber).classList.remove("d-none");
            /**
             * Select the form step circle (progress bar).
             */
            const formStepCircle = document.querySelector('li[step="' + stepNumber + '"]');
            /**
             * Mark the current form step as active.
             */
            formStepCircle.classList.remove("form-stepper-unfinished", "form-stepper-completed");
            formStepCircle.classList.add("form-stepper-active");
            /**
             * Loop through each form step circles.
             * This loop will continue up to the current step number.
             * Example: If the current step is 3,
             * then the loop will perform operations for step 1 and 2.
             */
            for (let index = 0; index < stepNumber; index++) {
                /**
                 * Select the form step circle (progress bar).
                 */
                const formStepCircle = document.querySelector('li[step="' + index + '"]');
                /**
                 * Check if the element exist. If yes, then proceed.
                 */
                if (formStepCircle) {
                    /**
                     * Mark the form step as completed.
                     */
                    formStepCircle.classList.remove("form-stepper-unfinished", "form-stepper-active");
                    formStepCircle.classList.add("form-stepper-completed");
                }
            }
        };
        /**
         * Select all form navigation buttons, and loop through them.
         */
        document.querySelectorAll(".btn-navigate-form-step").forEach((formNavigationBtn) => {
            /**
             * Add a click event listener to the button.
             */
            formNavigationBtn.addEventListener("click", () => {
                /**
                 * Get the value of the step.
                 */
                const stepNumber = parseInt(formNavigationBtn.getAttribute("step_number"));
                /**
                 * Call the function to navigate to the target form step.
                 */
                navigateToFormStep(stepNumber);
            });
        });


// '<form action="{{route(add-video)}}" method="POST"><div class="mt-3"><div class="form-row"><div class="form-group col-md-8"><hr style="height:2px;background-color:black"><br><label for="inputPassword">Upload New Video '+(x+1)+' </label><input type="file" class="form-control-file" accept="video/*"  id="inputProfile" name="course_video[]"></div></div><div class="form-row"><div class="form-group col-md-8"><label for="inputName">Video Title</label><input type="text" class="form-control" id="inputName" name="video_title[]" placeholder="Video Title"></div></div><div class="form-row"><div class="form-group col-md-8"><label for="description">Video Description</label><textarea class="form-control" id="course_description" name="video_description[]" rows="3" ></textarea></div></div><div class="form-row"><div class="form-group col-md-8"><label for="inputPassword">Upload Video Thumbnile</label><div class="input_fields_wrap"><input type="file" class="form-control-file"  id="inputProfile" accept="image/*" name="video_thumb[]"  style="margin-bottom: 15px;" multiple=""></div></div></div><div class="form-row"><div class="form-group col-md-8"><label for="inputPassword">Upload Documents</label><div class="input_fields_wrap"><input type="file" class="form-control-file" name="video_document'+x+'[]"  id="inputProfile" style="margin-bottom: 15px;" multiple=""></div></div></div><div class="input-group-append"><button class="btn btn-outline-danger remove_video_field" type="button">Remove</button></div> <div class="mt-3"><button class="button submit-btn" type="submit" name="saveData">Save</button></div><br></div></form>'
