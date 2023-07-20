function org_highchart(datas = [], nodes = [],struktur='') {

    Highcharts.chart('container', {
        chart: {
            height: 800,
            inverted: true
        },

        title: {
            text: 'STRUKTUR ORGANISASI '+struktur
        },

        accessibility: {
            point: {
                descriptionFormatter: function (point) {
                    var nodeName = point.toNode.name,
                        nodeId = point.toNode.id,
                        nodeDesc = nodeName === nodeId ? nodeName : nodeName + ', ' + nodeId,
                        parentDesc = point.fromNode.id;
                    return point.index + '. ' + nodeDesc + ', reports to ' + parentDesc + '.';
                }
            }
        },

        series: [{
            type: 'organization',
            name: 'Highsoft',
            keys: ['from', 'to'],
            data: datas,

            nodes: nodes,
            colorByPoint: false,
            color: '#007ad0',
            dataLabels: {
                color: 'white'
            },
            borderColor: 'white',
            nodeWidth: 60
        }],
        //     type: 'organization',
        //     name: 'Puskes TNI',
        //     keys: ['from', 'to'],
        //     data: [
        //         ['Kapuskes', 'Wakapuskes'],
        //         ['Wakapuskes', 'BIDUM'],
        //         ['Wakapuskes', 'DUKKESOPS'],
        //         ['Wakapuskes', 'YANKESIN'],
        //         ['Wakapuskes', 'BANGKES'],
        //         ['Wakapuskes', 'MATFASKES'],
        //         ['Wakapuskes', 'LAVIBIOVAK'],
        //         ['Wakapuskes', 'KERMABAKTIKES'],
        //         ['Wakapuskes', 'DOBEKKES'],
        //         ['Wakapuskes', 'TAUD'],
        //         ['Wakapuskes', 'PAKU'],
        //         ['Wakapuskes', 'SATLAKKES'],
        //     ],

        //     nodes: [{
        //         id: 'Kapuskes',
        //         title: 'KAPUSKES',
        //         name: 'dr. Budiman, Sp.BE, RE(K).,MARS',
        //         image: ``,
        //         column: 0,

        //     }, {
        //         id: 'Wakapuskes',
        //         title: 'WAKAPUSKES',
        //         name: 'dr. Guntoro, Sp.BP-RE(K)',
        //         image: ``,
        //         column: 1,

        //     }, {
        //         id: 'BIDUM',
        //         title: 'KABID UM',
        //         name: 'dr. Asnominanda, Sp.THT.KL',
        //         column: 2,
        //         image: ``
        //     }, {
        //         id: 'DUKKESOPS',
        //         title: 'KABID DUKKESOPS',
        //         name: 'dr. Moh. Birza Rizaldi, Sp.OG., M.A.R.S.',
        //         column: 2,
        //         image: ``
        //     }, {
        //         id: 'YANKESIN',
        //         title: 'KABID YANKESIN',
        //         name: 'dr. R.M Tjahja Nurrobi, M.Kes.,Sp.OT (K) Hand',
        //         column: 2,
        //         image: ``
        //     }, {
        //         id: 'BANGKES',
        //         title: 'KABID BANGKES',
        //         name: 'dr. Nunung Joko Nugroho',
        //         column: 3,
        //         image: ``
        //     }, {
        //         id: 'MATFASKES',
        //         title: 'KABID MATFASKES',
        //         name: 'Asngari, S.Si.,Apti',
        //         column: 3,
        //         image: ``
        //     }, {
        //         id: 'LAVIBIOVAK',
        //         title: 'KA LAVIBIOVAK',
        //         name: 'Drs. Nur Abdul Goni, M.Si',
        //         column: 3,
        //         image: ``
        //     }, {
        //         id: 'KERMABAKTIKES',
        //         title: 'KA UNIT KERMABAKTIKES',
        //         name: 'drg. Zelvya Purnama Rika, Sp.Kga., F.I.C.D., CIQnR',
        //         column: 4,
        //         image: ``
        //     }, {
        //         id: 'DOBEKKES',
        //         title: 'KA DOBEKKES',
        //         name: 'M.Washiluddin AR, SKM.,MKKK',
        //         column: 4,
        //         image: ``
        //     }, {
        //         id: 'TAUD',
        //         title: 'KA TAUD',
        //         name: '-',
        //         column: 4
        //     }, {
        //         id: 'PAKU',
        //         title: 'PAKU',
        //         name: '-',
        //         column: 5
        //     }, {
        //         id: 'SATLAKKES',
        //         title: 'KA SATLAKKES',
        //         name: '-',
        //         column: 5
        //     }],
        //     colorByPoint: false,
        //     color: '#007ad0',
        //     dataLabels: {
        //         color: 'white'
        //     },
        //     borderColor: 'white',
        //     nodeWidth: 80
        // }],
        tooltip: {
            outside: false
        },
        exporting: {
            allowHTML: true,
            sourceWidth: 800,
            sourceHeight: 600
        }

    });
}