/*jslint */
/*global AdobeEdge: false, window: false, document: false, console:false, alert: false */
(function (compId) {

    "use strict";
    var im='images/',
        aud='media/',
        vid='media/',
        js='js/',
        fonts = {
        },
        opts = {
            'gAudioPreloadPreference': 'auto',
            'gVideoPreloadPreference': 'auto'
        },
        resources = [
        ],
        scripts = [
        ],
        symbols = {
            "stage": {
                version: "6.0.0",
                minimumCompatibleVersion: "5.0.0",
                build: "6.0.0.400",
                scaleToFit: "both",
                centerStage: "both",
                resizeInstances: false,
                content: {
                    dom: [
                        {
                            id: 'Rectangle2',
                            type: 'rect',
                            rect: ['0px', '0px', '375px', '629px', 'auto', 'auto'],
                            fill: ["rgba(121,109,109,1.00)"],
                            stroke: [0,"rgb(0, 0, 0)","none"]
                        },
                        {
                            id: 'Ellipse4',
                            type: 'ellipse',
                            rect: ['53px', '142px', '270px', '339px', 'auto', 'auto'],
                            borderRadius: ["50%", "50%", "50%", "50%"],
                            fill: ["rgba(121,109,109,1)"],
                            stroke: [0,"rgb(0, 0, 0)","none"]
                        },
                        {
                            id: 'logo2',
                            type: 'image',
                            rect: ['95px', '164px', '187px', '206px', 'auto', 'auto'],
                            fill: ["rgba(0,0,0,0)",im+"logo2.png",'0px','0px']
                        },
                        {
                            id: 'Ellipse5Copy',
                            type: 'ellipse',
                            rect: ['-91px', '155px', '543px', '497px', 'auto', 'auto'],
                            borderRadius: ["50%", "50%", "50%", "50%"],
                            opacity: '1',
                            fill: ["rgba(120,108,108,0.99)"],
                            stroke: [0,"rgb(0, 0, 0)","none"],
                            filter: [0, 0, 0.94, 1, 0, 0, 0, 0, "rgba(0,0,0,0)", 0, 0, 0]
                        },
                        {
                            id: 'Ellipse6',
                            type: 'ellipse',
                            rect: ['55px', '132px', '270px', '296px', 'auto', 'auto'],
                            borderRadius: ["50%", "50%", "50%", "50%"],
                            opacity: '0',
                            fill: ["rgba(245,236,236,1.00)"],
                            stroke: [0,"rgb(0, 0, 0)","none"],
                            filter: [0, 0, 1, 1, 0, 0, 0, 0, "rgba(0,0,0,0)", 0, 0, 0],
                            transform: [[],[],[],['2.88','2.88']]
                        },
                        {
                            id: 'glas2',
                            type: 'image',
                            rect: ['-166px', '117px', '552px', '546px', 'auto', 'auto'],
                            opacity: '0.27918995725803',
                            fill: ["rgba(0,0,0,0)",im+"glas2.png",'0px','0px'],
                            filter: [0, 0, 0.94, 1, 0, 0, 0, 0, "rgba(0,0,0,0)", 0, 0, 0],
                            transform: [[],[],[],['0.91','0.91']]
                        },
                        {
                            id: 'light_atmospheric_clouds_stock_photo_2___png_by_annamae22-d81c5lk',
                            type: 'image',
                            rect: ['-358px', '-19px', '1042px', '506px', 'auto', 'auto'],
                            opacity: '0.60718371567687',
                            fill: ["rgba(0,0,0,0)",im+"light_atmospheric_clouds_stock_photo_2___png_by_annamae22-d81c5lk.png",'0px','0px']
                        },
                        {
                            id: 'crimescene',
                            type: 'image',
                            rect: ['0px', '428px', '380px', '152px', 'auto', 'auto'],
                            fill: ["rgba(0,0,0,0)",im+"crimescene.png",'0px','0px']
                        }
                    ],
                    style: {
                        '${Stage}': {
                            isStage: true,
                            rect: ['null', 'null', '375px', '627px', 'auto', 'auto'],
                            overflow: 'hidden',
                            fill: ["rgba(255,255,255,1)"]
                        }
                    }
                },
                timeline: {
                    duration: 1181,
                    autoPlay: true,
                    data: [
                        [
                            "eid40",
                            "opacity",
                            35,
                            0,
                            "linear",
                            "${Ellipse5Copy}",
                            '1',
                            '1'
                        ],
                        [
                            "eid35",
                            "opacity",
                            586,
                            0,
                            "linear",
                            "${Ellipse5Copy}",
                            '1',
                            '1'
                        ],
                        [
                            "eid36",
                            "opacity",
                            675,
                            0,
                            "linear",
                            "${Ellipse5Copy}",
                            '0.873634',
                            '0.68333928455285'
                        ],
                        [
                            "eid37",
                            "opacity",
                            768,
                            67,
                            "linear",
                            "${Ellipse5Copy}",
                            '0.68333928455285',
                            '0.26687169105691'
                        ],
                        [
                            "eid38",
                            "opacity",
                            835,
                            77,
                            "linear",
                            "${Ellipse5Copy}",
                            '0.26687169105691',
                            '0'
                        ],
                        [
                            "eid58",
                            "-webkit-transform-origin",
                            945,
                            0,
                            "linear",
                            "${glas2}",
                            [50,50],
                            [50,50],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid524",
                            "-moz-transform-origin",
                            945,
                            0,
                            "linear",
                            "${glas2}",
                            [50,50],
                            [50,50],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid525",
                            "-ms-transform-origin",
                            945,
                            0,
                            "linear",
                            "${glas2}",
                            [50,50],
                            [50,50],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid526",
                            "msTransformOrigin",
                            945,
                            0,
                            "linear",
                            "${glas2}",
                            [50,50],
                            [50,50],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid527",
                            "-o-transform-origin",
                            945,
                            0,
                            "linear",
                            "${glas2}",
                            [50,50],
                            [50,50],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid528",
                            "transform-origin",
                            945,
                            0,
                            "linear",
                            "${glas2}",
                            [50,50],
                            [50,50],
                            {valueTemplate: '@@0@@% @@1@@%'}
                        ],
                        [
                            "eid44",
                            "opacity",
                            0,
                            0,
                            "linear",
                            "${Ellipse6}",
                            '0',
                            '0'
                        ],
                        [
                            "eid52",
                            "opacity",
                            886,
                            0,
                            "linear",
                            "${glas2}",
                            '0',
                            '0'
                        ],
                        [
                            "eid53",
                            "opacity",
                            921,
                            0,
                            "linear",
                            "${glas2}",
                            '0',
                            '0'
                        ],
                        [
                            "eid54",
                            "opacity",
                            972,
                            209,
                            "linear",
                            "${glas2}",
                            '0',
                            '0.27918995725803'
                        ],
                        [
                            "eid497",
                            "left",
                            0,
                            0,
                            "linear",
                            "${light_atmospheric_clouds_stock_photo_2___png_by_annamae22-d81c5lk}",
                            '-358px',
                            '-358px'
                        ],
                        [
                            "eid498",
                            "left",
                            298,
                            0,
                            "linear",
                            "${light_atmospheric_clouds_stock_photo_2___png_by_annamae22-d81c5lk}",
                            '-347px',
                            '-347px'
                        ],
                        [
                            "eid502",
                            "left",
                            500,
                            0,
                            "linear",
                            "${light_atmospheric_clouds_stock_photo_2___png_by_annamae22-d81c5lk}",
                            '-502px',
                            '-502px'
                        ],
                        [
                            "eid503",
                            "left",
                            733,
                            0,
                            "linear",
                            "${light_atmospheric_clouds_stock_photo_2___png_by_annamae22-d81c5lk}",
                            '-502px',
                            '-502px'
                        ],
                        [
                            "eid499",
                            "left",
                            945,
                            0,
                            "linear",
                            "${light_atmospheric_clouds_stock_photo_2___png_by_annamae22-d81c5lk}",
                            '-502px',
                            '-502px'
                        ],
                        [
                            "eid500",
                            "left",
                            1122,
                            0,
                            "linear",
                            "${light_atmospheric_clouds_stock_photo_2___png_by_annamae22-d81c5lk}",
                            '-324px',
                            '-324px'
                        ]
                    ]
                }
            }
        };

    AdobeEdge.registerCompositionDefn(compId, symbols, fonts, scripts, resources, opts);

    if (!window.edge_authoring_mode) AdobeEdge.getComposition(compId).load("splash%20animation_edgeActions.js");
})("EDGE-120465314");
