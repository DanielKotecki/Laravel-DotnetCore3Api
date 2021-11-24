(function () {

    var table = document.querySelector("#myTable"),
        ths = table.querySelectorAll('thead th[id="th"]'),
        trs = table.querySelectorAll("tbody tr"),
        df = document.createDocumentFragment();

    function makeArray(nodeList) {
        var arr = [];
        for (let i = 0; i < nodeList.length; i++) {

            arr.push(nodeList[i]);
        }
        return arr;
    }
    function clearClassName(nodeList) {
        for (let x = 0; x < nodeList.length; x++) {
            nodeList[x].className = "";

        }
    }
    function sortBy(e) {
        var target = e.target;
        var thsArr = makeArray(ths);
        var trsArr = makeArray(trs);
        var order = (target.className === "" || target.className === "desc") ? "asc" : "desc";
        clearClassName(ths);
        // console.log(order);
        index = thsArr.indexOf(target);
        //console.log(index);
        trsArr.sort(function (a, b) {
            var tdA = a.children[index].textContent;
            var tdB = b.children[index].textContent;
            if (tdA < tdB) {
                return order === "asc" ? -1 : 1;
            } else if (tdA > tdB) {
                return order === "asc" ? 1 : -1;
            } else {
                return 0;
            }

        });
        trsArr.forEach(function (tr) {
            df.appendChild(tr);
        });
        target.className = order;
        table.querySelector('tbody').appendChild(df);

    }
    for (let index = 0; index < ths.length; index++) {
        ths[index].onclick = sortBy;

    }
})();