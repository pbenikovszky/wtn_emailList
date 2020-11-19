window.addEventListener("load", function() {
  const selectButtonTitles = ["Összes kijelölése", "Kijelölés törlése"];
  let selectButtonTitleIndex = 0;

  const btnAddNewAddress = document.getElementById("btn-add-new-address");
  const btnUpload = document.getElementById("btn-upload");
  const btnDownload = document.getElementById("btn-download");

  const btnSelectAll = document.getElementById("btn-selectall");
  const btnDeleteAll = document.getElementById("btn-deleteall");

  const addNewAddressForm = document.getElementById("add-new-email-form");
  const btnAdd = document.getElementById("btn-add");

  const uploadCSVForm = document.getElementById("upload-csv-form");

  const fileUploadForm = document.querySelector("form");
  const csvToUpload = document.getElementById("csvToUpload");

  addDeleteButtonListeners();

  btnAddNewAddress.addEventListener("click", function() {
    if (uploadCSVForm.classList.contains("active")) {
      uploadCSVForm.style.height = "0px";

      uploadCSVForm.addEventListener(
        "transitionend",
        function() {
          uploadCSVForm.classList.remove("active");
          animateForm(addNewAddressForm);
        },
        {
          once: true
        }
      );
    } else {
      animateForm(addNewAddressForm);
    }
  });

  btnUpload.addEventListener("click", function() {
    if (addNewAddressForm.classList.contains("active")) {
      addNewAddressForm.style.height = "0px";

      addNewAddressForm.addEventListener(
        "transitionend",
        function() {
          addNewAddressForm.classList.remove("active");
          animateForm(uploadCSVForm);
        },
        {
          once: true
        }
      );
    } else {
      animateForm(uploadCSVForm);
    }
  });

  btnSelectAll.addEventListener("click", function() {
    document.getElementsByName("cbSelect").forEach(cb => {
      cb.checked = selectButtonTitleIndex == 0;
    });

    selectButtonTitleIndex = 1 - selectButtonTitleIndex;
    btnSelectAll.innerText = selectButtonTitles[selectButtonTitleIndex];
  });

  btnAdd.addEventListener("click", function() {
    const newAddress = document.getElementById("new-address-field").value;
    if (newAddress == "") {
      return;
    }

    sendRequest("addemail", "emailaddress=" + newAddress);
  });

  btnDeleteAll.addEventListener("click", function() {
    let ids = [];

    document.getElementsByName("cbSelect").forEach(cb => {
      if (cb.checked) {
        ids.push(cb.value);
      }
    });

    if (ids.length > 0) {
      const msg =
        ids.length > 1
          ? "Biztosan törölni akarja a címeket?"
          : "Biztosan törölni akarja a címet?";
      const r = confirm(msg);
      if (r == true) {
        sendRequest("deleteemail", "emailaddress=" + ids.join(","));
      }
    }
  });

  btnDownload.addEventListener("click", function() {
    const csvRows = [];
    const emails = document.getElementsByClassName("email-column");

    for (let email of emails) {
      csvRows.push(email.innerText);
    }

    download(csvRows.join("\n"));
  });

  fileUploadForm.addEventListener("submit", e => {
    e.preventDefault();

    if (csvToUpload.files.length == 0) {
      return;
    }

    const myCsv = csvToUpload.files[0];
    const reader = new FileReader();

    reader.addEventListener("load", function(e) {
      const emails = e.target.result.split("\n").filter(function(line) {
        return line.length > 0;
      });

      const formattedEmails = [];
      for (let email of emails) {
        formattedEmails.push(`('${email.trim()}')`);
      }

      const emailList = formattedEmails.join(",");

      sendRequest("uploadlist", "emailaddress=" + emailList);
      // console.log(emailList)
    });

    reader.readAsBinaryString(myCsv);
  });

  function sendRequest(task, params) {
    let xhr = new XMLHttpRequest();
    let method = "POST";

    let url =
      "index.php?option=com_emaillista&view=emaillista&task=" +
      task +
      "&format=json";

    xhr.open(method, url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function() {
      // display error message and exit function
      // in case of any error
      if (xhr.status != 200) {
        alert("Error code " + xhr.status + ": " + xhr.responseText);
        return false;
      } // if

      // create a result object by parsing the returned JSON data
      let result = JSON.parse(xhr.response);

      // Reload the page after the successful change
      if (result.result === "SUCCESS") {
        // console.log("data: " + result.data)
        location.reload();
      } else {
        console.log("Hiba");
        return false;
      } // if
    }; // onload

    xhr.send(params);
  }

  function addDeleteButtonListeners() {
    const buttons = document.getElementsByClassName("tss-delete-button");

    for (let button of buttons) {
      button.addEventListener("click", function(e) {
        var r = confirm("Biztosan törölni akarja a címet?");
        if (r == true) {
          sendRequest("deleteemail", "emailaddress=" + e.target.dataset.id);
        }
      });
    }
  }

  // Generate CSV from object
  function download(data) {
    // console.log(data);
    const blob = new Blob([data], {
      type: "text/csv"
    });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement("a");
    a.setAttribute("hidden", "");
    a.setAttribute("href", url);
    a.setAttribute("download", "email_lista.csv");
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
  }

  // animate forms
  function animateForm(container) {
    if (!container.classList.contains("active")) {
      container.classList.add("active");
      container.style.height = "auto";

      var height = container.clientHeight + "px";

      container.style.height = "0px";

      setTimeout(function() {
        container.style.height = height;
      }, 0);
    } else {
      container.style.height = "0px";

      container.addEventListener(
        "transitionend",
        function() {
          container.classList.remove("active");
        },
        {
          once: true
        }
      );
    }
  }
});
