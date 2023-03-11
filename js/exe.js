const options = {
  method: "GET",
  headers: {
    "X-RapidAPI-Key": "6c5d48f377mshd4961a465237233p11e2bdjsn8f5f6336d1d7",
    "X-RapidAPI-Host": "exercisedb.p.rapidapi.com",
  },
};
let select = document.getElementById("select");
select.addEventListener("change", () => {
    fetch(`js/${select.value}.json`)
      .then((response) => response.json())
        .then((response) => {
            let data = response;
            console.log(data);
            console.log(data.length);
            let btnCount = Math.ceil(data.length / 20);
            console.log(btnCount);
            document.getElementById("content").innerHTML = "";
            for (let n = 0; n < 20; n++) {
              document.getElementById("content").innerHTML += `
                            <div class="exercise col-md-2 col-10">
                                <img src="${data[n].gifUrl}" alt="${data[n].name}">
                                <a href='${data[n].gifUrl}' download='${data[n].name}' target='_blank'>Download <i class="fa-solid fa-download"></i></a>
                            </div>
                        `;
            }
            document.querySelector(".pagination").innerHTML='';
            for (let i = 0; i < btnCount; i++){
                let btn = document.createElement('button');
                btn.classList.add("bg-danger");
                btn.classList.add("pag");
                let btnText = document.createTextNode(i + 1);
                btn.append(btnText);
                document.querySelector(".pagination").append(btn);
                btn.addEventListener('click', () => {
                    let s = i * 20;
                    let e = (i + 1) * 20;
                    document.getElementById("content").innerHTML = '';
                    for (; s < e;s++){
                        document.getElementById("content").innerHTML += `
                            <div class="exercise col-md-2 col-10">
                                <img src="${data[s].gifUrl}" alt="${data[s].name}">
                                <a href='${data[s].gifUrl}' download='${data[s].name}' target='_blank'>Download <i class="fa-solid fa-download"></i></a>
                            </div>
                        `;
                    }
                })
            }
      })
      .catch((err) => console.error(err));
    // console.log(data);
});
