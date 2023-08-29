var imgs = document.getElementById("imgs");
myFunction(imgs) ;

function myFunction(imgs) {
    var expandImg = document.getElementById("expandedImg");
    expandImg.src = imgs.src;
    expandImg.parentElement.style.display = "block";
  } 



  const copyButton = document.getElementById("copyButton");
  copyButton.addEventListener("click", () => {
      const url = window.location.href;

      // Create a temporary textarea to hold the URL
      const tempTextArea = document.createElement("textarea");
      tempTextArea.value = url;
      document.body.appendChild(tempTextArea);
      tempTextArea.select();
      document.execCommand("copy");
      document.body.removeChild(tempTextArea);
  });

  