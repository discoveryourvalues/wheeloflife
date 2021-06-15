<?php require_once('header.php') ?>

<main id="mainWrapper">
</main>

<script>

    function openResultsPage() {
        window.history.pushState("Dummy Data", "Results - Wheel of Life", "./results.php");
        $("body").load("./results.php");
    }

    function hideSection(sectionID) {
        let Section = $("#wheelSection" + sectionID);
        Section.removeClass("visible");
        Section.addClass("hide");

        let nextSectionID = sectionID + 1;
        displaySection(nextSectionID);
    }

    function displaySection(sectionID) {
        let Section = $("#wheelSection" + sectionID);
        let Now = Section.find("#Now");
        let Future = Section.find("#Future");

        Section.removeClass("hide");
        Section.addClass("visible");
        Now.removeClass("hide");
        Now.addClass("visible");
    }

    function displayFutureSubSection(sectionID) {
        let Section = $("#wheelSection" + sectionID);
        let Now = Section.find("#Now");
        let Future = Section.find("#Future");

        Now.removeClass("visible");
        Now.addClass("hide");
        Future.removeClass("hide");
        Future.addClass("visible");
    }

    function addOptions(option, parentDiv, sID) {
        parentDiv.empty();
        for (let i = 1; i <= 10; i++) {
            let $button = $("<button>", {
                id: "choice",
                class: "choiceOptions"
            });
            let $buttonHTML = $button[0];
            $buttonHTML.innerHTML = i;
            $button.click(function () {
                if (parentDiv[0].id == "Now_Options") {
                    optionsObject[sID]["now"] = this.innerHTML;
                    displayFutureSubSection(sID); //Display Future subsection of Same Section ID

                } else if (parentDiv[0].id == "Future_Options") {
                    optionsObject[sID]["future"] = this.innerHTML;
                    optionsObject[sID]["diff"] = optionsObject[sID]["future"] - optionsObject[sID]["now"];
                    hideSection(sID); //Display Now subsection of Next Section ID
                    if (sID == globalOptions.length - 1) {
                        openResultsPage();
                    }
                }

                console.log(this.innerHTML);
                console.log(optionsObject);

            });
            parentDiv.append($buttonHTML);
        }

    }



    function subSectionNow(option, Section, sID) {
        let Now = Section.find("#Now");
        let nowHeading = Now.find("#Now_Heading > span");
        let nowQuestion = Now.find("#Now_Question");
        let nowOptionsContainer = Now.find("#Now_Options");

        nowHeading[0].innerHTML = option;

        nowQuestion[0].innerHTML = "<div>How do you feel about your <br><span></span> right now?</div>"
        nowQuestion.find("span")[0].innerHTML = option;

        addOptions(option, nowOptionsContainer, sID);
        console.log(Now, nowHeading, nowQuestion, nowOptionsContainer);
    }

    function subSectionFuture(option, Section, sID) {
        let Future = Section.find("#Future");
        let futureHeading = Future.find("#Future_Heading > span");
        let futureQuestion = Future.find("#Future_Question");
        let futureOptionsContainer = Future.find("#Future_Options");

        futureHeading[0].innerHTML = option;

        futureQuestion[0].innerHTML = "<div>How do you feel about your <br><span></span> in future?</div>";
        futureQuestion.find("span")[0].innerHTML = option;

        addOptions(option, futureOptionsContainer, sID);
        console.log(Future, futureHeading, futureQuestion, futureOptionsContainer);

    }

    function section(options, ID) {
        let sectionID = ID;
        let Section = $("#wheelSection" + sectionID);
        optionsObject[sectionID]["SectionName"] = options[sectionID];
        console.log(Section);
        subSectionNow(options[sectionID], Section, sectionID);
        subSectionFuture(options[sectionID], Section, sectionID);
        
        let skipQuestion = Section.find("#skipQuestion");
        
        skipQuestion.click(function () {
            console.log(this);
            
            optionsObject[sectionID]["now"] = -1;
            optionsObject[sectionID]["future"] = -1;
            optionsObject[sectionID]["diff"] = -1;
            
            hideSection(sectionID); //Display Now subsection of Next Section ID
            if (sectionID == globalOptions.length - 1) {
                openResultsPage();
            }
        });

        if (sectionID == 0) {
            displaySection(ID, "Now");
        }


    }

    function startSurvey(options) {
        for (let i = 0; i <= 7; i++) {
            if (i <= 7) {
                console.log(i);
                let sectionHTML = $("<section>", {
                    id: "wheelSection" + i,
                    class: "hide"
                });
                console.log(sectionHTML);

                sectionHTML[0].innerHTML = '<div id="Now" class="hide"><h1 id="Now_Heading"><span></span></h1><p id="Now_Question"></p><div id="Now_Options"></div></div><div id="Future" class="hide"><h1 id="Future_Heading"><span></span></h1><p id="Future_Question"></p><div id="Future_Options"></div></div><div id="skipQuestion"><a href="#">Skip this question</a></div>';
                //$("#mainWrapper")[0].append(sectionHTML[0]);
                $("#mainWrapper")[0].appendChild(sectionHTML[0]);
            }
            section(options, i);
        }

    }

    startSurvey(globalOptions);
    console.log(globalOptions);
    console.log(optionsObject);
</script>
