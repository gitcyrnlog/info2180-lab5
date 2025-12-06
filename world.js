window.onload = function () {
    const lookupBtn = document.getElementById("lookup");
    const cityBtn = document.getElementById("lookup-cities");
    const resultDiv = document.getElementById("result");

    lookupBtn.addEventListener("click", function () {
        const country = document.getElementById("country").value.trim();
        fetch(`world.php?country=${country}`)
            .then(response => response.text())
            .then(data => {
                resultDiv.innerHTML = data;
            });
    });

    cityBtn.addEventListener("click", function () {
        const country = document.getElementById("country").value.trim();
        fetch(`world.php?country=${country}&lookup=cities`)
            .then(response => response.text())
            .then(data => {
                resultDiv.innerHTML = data;
            });
    });
};
