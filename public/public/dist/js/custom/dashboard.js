$.fn.isInViewport = function () {
    if (this.length == 0) {
        return false;
    }
    return this[0].getBoundingClientRect().top < $(window).height();
};

class AjaxRequest {
    // Fetch data from the url
    static async call(url, params = {}) {
        let options = Object.assign(
            {
                method: "GET", // *GET, POST, PUT, DELETE, etc.
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                },
            },
            params
        );

        let data = await fetch(url, options)
            .then((response) => response.json())
            .then((data) => data.response);
        return data;
    }
}

class Dashboard {
    element;
    fetched = false;
    links = [];
    params = {};

    static getObject() {
        // Returns the class object
        if (this.myself == null) {
            // If object is not already available then create a new one
            this.myself = new this();
        }
        return this.myself;
    }

    async update(url) {
        this.fetched = true;

        // Make api call to fetch data
        let data = await AjaxRequest.call(url, this.params);
        if (this.getStatus(data)) {
            // render 5 row in the table
            this.renderData(this.element, data);
        } else {
            throw new Error(this.getErrMessage(data));
        }
    }

    sliceData(data, count = 5) {
        return data.slice(0, count);
    }

    // Hide place holder and show the data
    switchView() {
        this.element.find(".placeholder-data").addClass("d-none");
        this.element.find(".original-data").removeClass("d-none");
    }

    sync(url) {
        if (!this.hasObject()) {
            return;
        }
        if (!this.fetched && this.element.isInViewport() && url) {
            this.update(url);
        }
    }

    hasObject() {
        if (this.element == undefined || this.element.length < 1) {
            return false;
        }
        return true;
    }

    renderData() {
        throw new Error("Must implement renderData() method.");
    }

    getStatus(data) {
        // This line is for testing purpose
        return true;

        if (data.status && data.status.code && data.status.code == 200) {
            return true;
        }
        return false;
    }

    getErrMessage(data) {
        return data.status.message;
    }

    formatString(str, len = 20, ending = "...") {
        if (str.length > len - ending.length) {
            return str.substr(0, len) + ending;
        }
        return str;
    }

    formatUrl(url, param, key = null) {
        if (!key) {
            return url.replace("__id__", param);
        }
        return url.replace(key, param);
    }

    addLink(url, key) {
        this.links[key] = url;
        return this;
    }

    getLink(type, param, key = null) {
        if (this.links[type] == undefined) {
            return "#";
        }

        if (!key) {
            return this.links[type].replace("__id__", param);
        }
        return this.links[type].replace(key, param);
    }

    setParams(params) {
        this.params = params;
        return this;
    }
    resetFetch() {
        this.fetched = false;
        return this;
    }
}

class DashReport extends Dashboard {
    static myself = null;
    constructor() {
        super();
        super.element = $("#dashboard-reports");
    }

    // render table row from the data
    renderData(parent, data) {
        data = super.sliceData(data.records);
        let tr = "";
        data.forEach((item) => {
            tr += "<tr class='unread'><td><img></td>";
            tr += "<td><h6>" + item.title.substr(0, 20) + "</H6></td>";
            tr += '<td class=""><h6>11 MAY 12:56</h6></td>';
            tr +=
                '<td class=""><a href="#!" class="label bg-c-blue text-white f-12">View</a></td>';
            tr += "</tr>";
        });
        parent.find(".original-data").append(tr);
        super.switchView();
    }
}

class VendorStats extends Dashboard {
    static myself = null;
    constructor() {
        super();
        super.element = $("#vendor-stat");
    }

    // render table row from the data
    renderData(parent, data) {
        data = super.sliceData(data.records);
        let tr = "";
        let counter = 1;
        data.forEach((item) => {
            if (item.name) {
                tr +=
                    "<tr class='unread'><td><h6 class='mb-1'>" +
                    counter++ +
                    "</h6></td>";
                tr +=
                    '<td><h6 class="has-dash-popup" data-url="' +
                    item.url +
                    '">' +
                    item.name.substr(0, 20)  +
                    "</H6></td>";
                tr += '<td class="text-center">';
                for (let index = 1; index <= 5; index++) {
                    if (item.ratings > 0) {
                        tr +=
                            '<a href="#!"><i class="fa fa-star f-12 text-c-yellow"></i></a>';
                    } else {
                        tr +=
                            '<a href="#!"><i class="fa fa-star f-12 text-black-50"></i></a>';
                    }
                    item.ratings--;
                }
                tr += "</td>";
                tr +=
                    '<td><h6 class="text-center m-b-0">' +
                    item.orders +
                    "</h6></td>";
                tr +=
                    '<td><h6 class="text-center m-b-0">' +
                    item.sales +
                    "</h6></td>";
                tr +=
                    '<td class="text-center"><a href="' +
                    super.getLink("edit", item.id) +
                    '" class="label theme-bg f-12 text-white">'+jsLang('VIEW')+'</a></td>';
                tr += "</tr>";
            }
        });
        parent.find(".original-data").append(tr);
        super.switchView();
    }
}

class MostVisitedReport extends Dashboard {
    static myself = null;
    constructor() {
        super();
        super.element = $("#most-visited-page");
    }

    renderData(parent, data) {
        data = super.sliceData(data.records);
        let tr = "";
        data.forEach((item) => {
            tr += '<tr class="unread">';
            tr += "<td><H6>" + item.title.substr(0, 20) + "</H6></td>";
            tr +=
                '<td class="text-right"><h6>' +
                Math.floor(Math.random() * 100 + 50) +
                "</h6></td>";
            tr += "</tr>";
        });
        parent.find(".original-data").append(tr);
        super.switchView();
    }
}

class CustomerComplain extends Dashboard {
    static myself = null;
    constructor() {
        super();
        super.element = $("#customer-complain");
    }

    renderData(parent, data) {
        super.switchView();
    }
}

class MostActiveUsers extends Dashboard {
    static myself = null;
    constructor() {
        super();
        super.element = $("#most-active-users");
    }

    renderData(parent, data) {
        data = super.sliceData(data.records);
        let tr = "";
        data.forEach((item) => {
            tr += "<tr class='unread'>";
            tr +=
                '<td><h6 class="has-dash-popup" data-url="' +
                item.profile +
                '">' +
                super.formatString(item.name) +
                "</h6></td>";
            tr += '<td class="text-right">' + item.total + " </td>";
            tr += "</tr>";
        });
        parent.find(".original-data").append(tr);
        super.switchView();
    }
}

class MostSoldProducts extends Dashboard {
    static myself = null;
    constructor() {
        super();
        super.element = $("#most-sold-products");
    }

    renderData(parent, data) {
        data = super.sliceData(data.records);
        let tr = "";
        data.forEach((item) => {
            tr += "<tr class='unread'>";
            tr += `<td><h6 class='m-0 p-0 btn has-dash-popup' data-url='${
                item.url
            }'>${super.formatString(item.name)}</h6></td>`;
            tr += '<td class="text-right">' + item.total + " </td>";
            tr += "</tr>";
        });
        parent.find(".original-data").append(tr);
        super.switchView();
    }
}

class SaleOfThisMonth extends Dashboard {
    static myself = null;
    constructor() {
        super();
        super.element = $("#sale-of-this-month");
    }

    renderData(parent, data) {
        this.lineChart(parent, data);
        super.switchView();
    }

    lineChart = (parent, data) => {
        parent.find(".placeholder").addClass("d-none");
        let chartCanvas = parent.find("#chart-area-2");
        chartCanvas.removeClass("d-none");
        this.updateChart(chartCanvas[0], data.records);
    };

    updateChart = (chartCanvas, data) => {
        var bar = chartCanvas.getContext("2d");
        var theme_g1 = bar.createLinearGradient(0, 0, 500, 0);
        theme_g1.addColorStop(0, "rgba(29, 233, 182, 0.8)");
        theme_g1.addColorStop(1, "rgba(29, 196, 233, 0.8)");
        var data1 = {
            labels: data.dates,
            datasets: [
                {
                    label: data.thisMonth,
                    data: data.values,
                    borderWidth: 4,
                    borderColor: theme_g1,
                    backgroundColor: theme_g1,
                    hoverborderColor: theme_g1,
                    hoverBackgroundColor: theme_g1,
                    tension: 0.1,
                },
            ],
        };
        var myBarChart = new Chart(bar, {
            type: "line",
            data: data1,
            responsive: true,
            fill: true,
            options: {
                scales: {
                    y: {
                        title: {
                            display: true,
                            text: "Sales",
                        },
                    },
                },
            },
        });
    };
}

class VendorReq extends Dashboard {
    static myself = null;
    constructor() {
        super();
        super.element = $("#vendor-request");
    }

    // render table row from the data
    renderData(parent, data) {
        data = super.sliceData(data.records);
        let tr = "";
        let counter = 1;
        data.forEach((user) => {
            tr += '<tr class="unread">';
            tr += '<td> <img class="rounded-circle" style="width:40px;" src="'+user.file_url+'" alt="activity-user"> </td>'
            tr += '<td><h6 class="user-has-popup mb-1">'+user.name.substr(0, 20)+'</h6></td>'
            tr += '<td class="text-center"> <h6 class="text-muted">'+user.created_at+'</h6></td>';
            tr += '<td class="text-right"> <a href="'+user.view+'" class="label bg-c-blue text-white f-12">'+jsLang('View')+'</a><a href="javascript:void(0)" class="label theme-bg f-12 text-white vendor-req" data-url="'+user.accept+'">'+jsLang('Accept')+'</a><a href="javascript:void(0)" class="label theme-bg2 text-white f-12 vendor-req" data-url="'+user.reject+'">'+jsLang('Reject')+'</a></td>';
            tr += '</tr>';
        });
        parent.find(".original-data").append(tr);
        super.switchView();
    }
}

$(document).ready(function () {
    const checkStatus = () => {
        DashReport.getObject().sync();
        MostVisitedReport.getObject().sync();
        CustomerComplain.getObject().sync();
        VendorStats.getObject()
            .addLink(vendorEdiUrl, "edit")
            .sync(vendorStatsUrl);
        MostActiveUsers.getObject().sync(mostActiveUsersUrl);
        MostSoldProducts.getObject().sync(mostSoldProductsUrl);
        SaleOfThisMonth.getObject().sync(salesOfThisMonth);
        VendorReq.getObject()
            .addLink(vendorReqsUrl, "edit")
            .sync(vendorReqsUrl);
    };

    $(document).scroll(() => {
        checkStatus();
    });

    $(document).on('click', '.daily', function (e) {
        e.preventDefault();
        switchReload();
        VendorStats.getObject()
            .resetFetch()
            .sync(vendorStatsUrlDaily);
    });

    $(document).on('click', '.weekly', function (e) {
        e.preventDefault();
        switchReload();
        VendorStats.getObject()
            .resetFetch()
            .sync(vendorStatsUrlWeekly);
    });

    $(document).on('click', '.monthly', function (e) {
        e.preventDefault();
        switchReload();
        VendorStats.getObject()
            .resetFetch()
            .sync(vendorStatsUrlMonthly);
    });

    $(document).on('click', '.yearly', function (e) {
        e.preventDefault();
        switchReload();
        VendorStats.getObject()
            .resetFetch()
            .sync(vendorStatsUrlYearly);
    });

    $(document).on('click', '.vendor-req', function (e) {
        e.preventDefault();
        let url = $(this).attr('data-url');
        VendorReqSwitchReload();
        VendorReq.getObject()
            .resetFetch()
            .sync(url);
    });

    function switchReload()
    {
        $(".placeholder-data-sta").removeClass("d-none");
        $(".original-data-sta").addClass("d-none");
        $(".original-data-sta").empty();
    }

    function VendorReqSwitchReload()
    {
        $(".placeholder-data-req").removeClass("d-none");
        $(".original-data-req").addClass("d-none");
        $(".original-data-req").empty();
    }

    checkStatus();
});
