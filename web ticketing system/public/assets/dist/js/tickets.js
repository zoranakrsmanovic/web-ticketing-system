function loadMoreDataTickets0(jQueryObjectLoadMore, jQueryObjectLoadMoreBtn, jQueryObjectProgress, url, numberOfPage, numberOfRows){
    var data = { "numberOfPage": numberOfPage, "numberOfRows": numberOfRows};

    $.ajax({
        method: "GET",
        url: url,
        data: data,
        dataType: "json",
        success: function (result){
            if (result == null || result.length == 0 || result.length < 1){

                jQueryObjectLoadMoreBtn.html("There is no more data to show!");
                jQueryObjectLoadMoreBtn.prop('disabled', true);
            }

            if (result != null && result.length > 0)
            {
                $.each(result, function (index, item){
                    jQueryObjectLoadMore.append(
                        "<tr>" +
                        "<td class='text-center'>" + item.title + "</td>" +
                        "<td class='text-center'>" + item.content + "</td>" +
                        "<td class='text-center'>" + item.created_at + "</td>" +
                        "<td class='text-center'>" + updated(item.updated_at) + "</td>" +
                        "<td class='text-center'>" + status(item.status_id) + "</td>" +
                        "<td class='text-center'>" + priority(item.priority_id) + "</td>" +
                        "<td class='text-center'>" + solution(item.solution) + "</td>" +
                        "<td class='text-center'>" + categories(item.category_id) + "</td>" +
                        "<td class='text-center'>" +
                        "<a href='/ticketDetails?ticket_id="+ item.ticket_id +"' class='btn btn-info'>Details</a> &nbsp;" +
                        "</td>" +
                        "</tr>"
                    );
                });
            }
        },
        error: function (){
            alert("Error loading data!");
        },
        beforeSend: function (){
            jQueryObjectProgress.show();
        },
        complete: function (){
            jQueryObjectProgress.hide();
        }
    });
}

function status(data) {
    if (data == 1 || data == null) {
        return "Active";
    } else {
        return "Closed";
    }
}

function priority(data) {
    if (data == 1) {
        return "Low";
    } else if (data == 2) {
        return "High";
    } else {
        return "Not set";
    };
}

function updated(data) {
    if (data == null) {
        return "Ticket still active";
    } else {
        return data;
    }
}

function categories(data) {
    let category;
    switch (data) {
        case "1":
            category = "Connection issues";
            break;
        case "2":
            category = "Equipment issues";
            console.log("test");
            break;
        case "3":
            category = "Technical questions";
            break;
        default:
            category = "Not categorised";
            break;
    }
    return category;
}

function solution(data) {
    if (data == null) {
        return "Ticket still active"
    } else {
        return data;
    }
}

function loadMoreDataTickets(jQueryObjectLoadMore, jQueryObjectLoadMoreBtn, jQueryObjectProgress, url, numberOfPage, numberOfRows, search){
    var data = { "numberOfPage": numberOfPage, "numberOfRows": numberOfRows, "search": search };

    $.ajax({
        method: "GET",
        url: url,
        data: data,
        dataType: "json",
        success: function (result){
            if (result == null || result.length == 0 || result.length < 1){

                jQueryObjectLoadMoreBtn.html("There is no more data to show!");
                jQueryObjectLoadMoreBtn.prop('disabled', true);
            }

            if (result != null && result.length > 0)
            {
                $.each(result, function (index, item){
                    jQueryObjectLoadMore.append(
                        "<tr>" +
                        "<td class='text-center'>" + item.title + "</td>" +
                        "<td class='text-center'>" + item.content + "</td>" +
                        "<td class='text-center'>" + item.created_at + "</td>" +
                        "<td class='text-center'>" + updated(item.updated_at) + "</td>" +
                        "<td class='text-center'>" + status(item.status_id) + "</td>" +
                        "<td class='text-center'>" + priority(item.priority_id) + "</td>" +
                        "<td class='text-center'>" + solution(item.solution) + "</td>" +
                        "<td class='text-center'>" + categories(item.category_id) + "</td>" +
                        "<td class='text-center'>" +
                        "<a href='/ticketEdit?ticket_id="+ item.ticket_id +"' class='btn btn-info'>Edit</a> &nbsp;" +
                        "</td>" +
                        "</tr>"
                    );
                });
            }
        },
        error: function (){
            alert("Error loading data!");
        },
        beforeSend: function (){
            jQueryObjectProgress.show();
        },
        complete: function (){
            jQueryObjectProgress.hide();
        }
    });
}
