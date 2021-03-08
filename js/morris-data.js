$(function() {

    Morris.Bar({
        element: 'morris-bar-chart',
        data: [
		 {
            y: '2010',
            a: 75,
            b: 65,
			c: 90
        }, {
            y: '2011',
            a: 50,
            b: 40,
			c: 90
        }, {
            y: '2012',
            a: 75,
            b: 65,
			c: 90
        }, {
            y: '2013',
            a: 50,
            b: 40,
			c: 90
        }, {
            y: '2014',
            a: 75,
            b: 65,
			c: 90
        }, {
            y: '2015',
            a: 156,
            b: 90,
			c: 90
        },
		],
        xkey: 'y',
        ykeys: ['a', 'b','c'],
        labels: ['Series A', 'Series B', 'Series C'],
        hideHover: 'auto',
        resize: true
    });

});
