let selectedTags = [],
    tagSearch = document.querySelector("#tagSearch"),
    tagsResults = document.querySelector("#tagsResults ul"),
    addTagBtn = document.querySelector("#addTagBtn"),
    selectedTagsHiddenInput = document.querySelector("#selectedTags");

function init() {
    tagSearch.addEventListener("input", function (e) {
        tagsResults.innerHTML = "";
        if (tagSearch.value == "") return;
        let xhr = new XMLHttpRequest();
        xhr.open(
            "GET",
            "index.php?controller=API&action=getTags&searchText=" +
                tagSearch.value,
            true
        );
        xhr.send();
        xhr.onload = function () {
            if (xhr.status === 200) {
                let tags = JSON.parse(xhr.responseText);
                for (let i = 0; i < tags.length; i++) {
                    let li = document.createElement("li");
                    li.classList.add("list-group-item");
                    li.textContent = tags[i].tag_title;
                    li.addEventListener("click", function (e) {
                        tagSearch.value = tags[i].tag_title;
                        tagsResults.innerHTML = "";
                    });
                    tagsResults.appendChild(li);
                }
            }
        };
    });

    addTagBtn.addEventListener("click", function (e) {
        if (tagSearch.value == "") return;
        selectedTags.push({
            title: tagSearch.value,
        });
        tagSearch.value = "";
        updateSelectedTags();
    });
    updateSelectedTags();
}

function updateSelectedTags() {
    let tagsList = document.querySelector("ul.tagsList");
    tagsList.innerHTML = "";
    selectedTagsHiddenInput.value = JSON.stringify(selectedTags);
    for (let i = 0; i < selectedTags.length; i++) {
        let li = document.createElement("li");
        li.classList.add("list-group-item");
        li.textContent = selectedTags[i].title;
        li.addEventListener("click", function (e) {
            selectedTags.splice(i, 1);
            updateSelectedTags();
        });
        tagsList.appendChild(li);
    }
    if (selectedTags.length === 0) {
        tagsList.innerHTML =
            '<div class="alert alert-warning" role="alert">Aucun tag sélectionné</div>';
    }
}

init();
