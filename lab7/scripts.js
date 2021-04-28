let ajax1 = new XMLHttpRequest();

function loadData1() {
    if (ajax1.status === 200) {
        console.dir(ajax1.response);
        document.getElementById("result1").innerHTML = ajax1.response;
    }
}

function get1post() {
    ajax1.onload = loadData1;
    let project_name = document.getElementById("project_name").value;
    let current_date = document.getElementById("current_date").value;
    ajax1.open("POST", "query_date.php");
    ajax1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax1.send(`project_name=${project_name}&current_date=${current_date}`);
}


let ajax2 = new XMLHttpRequest();

function loadData2() {
    if (ajax2.status === 200) {
        console.dir(ajax2);
        console.dir(ajax2.response);
        var all_time = 0;
        var res = document.getElementById("result2");
        var result = "";
        var rows = ajax2.responseXML.firstChild.children;
        for (var i = 0; i < rows.length; i++) {
            result += "<tr>";
            result += "<td>" + rows[i].children[0].firstChild.nodeValue + "</td>";
            result += "<td>" + rows[i].children[1].textContent + "</td>";
            result += "<td>" + rows[i].children[2].textContent + "</td>";
            result += "<td>" + rows[i].children[3].textContent + "</td>";
            all_time += Number(rows[i].children[3].textContent);
            result += "</tr>";
        }
        result += `<tr><td>Общее количество дней:</td><td></td><td></td><td>${all_time}</td>`
        res.innerHTML = result;
        // console.log(all_time);
    }
}

function get2post() {
    ajax2.onload = loadData2;
    let project_name2 = document.getElementById("project_name2").value;
    ajax2.open("POST", "get_all_time.php");
    ajax2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax2.send(`project_name=${project_name2}`);
}


let ajax3 = new XMLHttpRequest();

function loadData3() {
    if (ajax3.status === 200) {
        console.dir(ajax3);
        // document.getElementById("result1").innerHTML = ajax3.response;
        let res = JSON.parse(ajax3.response);
        console.dir(res);
        let total_employees = res.length
        let result = "";
        for (let i in res) {
            result += "<tr>";
            result += "<td>" + res[i].Manager + "</td>";
            result += "<td>" + res[i]["Employee ID"] + "</td>";
            result += "</tr>";
        }
        result += `<tr><td>Общее количество сотрудников:</td><td>${total_employees}</td>`
        document.getElementById("result3").innerHTML = result;
    }
}

function get3post() {
    ajax3.onload = loadData3;
    let chief_name = document.getElementById("chief_name").value;
    ajax3.open("POST", "chief.php");
    ajax3.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajax3.send(`chief_name=${chief_name}`);
}

