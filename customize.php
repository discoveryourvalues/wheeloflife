<?php require_once 'header.php'?>

<h1 class="customizePageHeading">Customize your own wheel</h1>

<section id="customizeOptions">

    <div class="csOptionsFieldsWrapper">
        <div class="customizeOptionsInputContainer">
            <label for="sec1"> Option 1</label>
            <input type="text" class="form-control" id="sec1" name="sec1" required="true" placeholder="e.g. Career">
        </div>
        
        <div class="customizeOptionsInputContainer">
            <label for="sec2"> Option 2</label>
            <input type="text" class="form-control" id="sec2" name="sec2" required="true" placeholder="e.g. Money">
        </div>

        
        <div class="customizeOptionsInputContainer">
            <label for="sec3"> Option 3</label>
            <input type="text" class="form-control" id="sec3" name="sec3" required="true" placeholder="e.g. Health">
        </div>

        <div class="customizeOptionsInputContainer">
            <label for="sec4"> Option 4</label>
            <input type="text" class="form-control" id="sec4" name="sec4" required="true" placeholder="e.g. Relationships">
        </div>

        <div class="customizeOptionsInputContainer">
            <label for="sec5"> Option 5</label>
            <input type="text" class="form-control" id="sec5" name="sec5" required="true" placeholder="e.g. Personal Growth
">
        </div>

        <div class="customizeOptionsInputContainer">
            <label for="sec6"> Option 6</label>
            <input type="text" class="form-control" id="sec6" name="sec6" required="true" placeholder="e.g. Fun / Recreation">
        </div>

        <div class="customizeOptionsInputContainer">
            <label for="sec7"> Option 7</label>
            <input type="text" class="form-control" id="sec7" name="sec7" required="true" placeholder="e.g. Physical Environment">
        </div>

        <div class="customizeOptionsInputContainer">
            <label for="sec8"> Option 8</label>
            <input type="text" class="form-control" id="sec8" name="sec8" required="true" placeholder="e.g. Spirituality">
        </div>
    </div>

    <div class="submitContainer">
        <span id="error"></span>
        <a href="#" id="submit">Make Wheel</a>
        <span>
            <a href="./index.php">
                Go back
            </a>
        </span>
    </div>

</section>

<script>


    function redirectToSureveyPage() {
        window.history.pushState("Dummy Data", "Survey - Wheel of Life", "./survey.php");
        $("body").load("./survey.php");
    }

    function checkFields(){
        console.log("checking fields");
        let newOptions = [];
        for (let i = 1; i <= 8; i ++){
            let input = $("#sec"+i)[0];
            let inputValue = input.value
            console.log(input);
            if (inputValue == ""){
                $("#error")[0].innerHTML = "Fill All Fields";
                break;
            }
            else {
                $("#error")[0].innerHTML = "All Fields Completed";
                newOptions.push(inputValue);
            }
        }
        return newOptions;
    }

    function submitCustomizePage(){
        $("#submit").click(function(){
            console.log("submit clicked");
            let csOptions = checkFields();
            globalOptions = csOptions;
            console.log("Global Options:", globalOptions);
            if(globalOptions.length == 8){
                redirectToSureveyPage();
            }
        });
    }


    submitCustomizePage();


</script>

<?php
    $footer_id="customizePage";
?>
<?php require_once 'footer.php'?>