﻿/*
 Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.html or http://ckeditor.com/license
 */

/**
 * @fileOverview Defines the {@link CKEDITOR.lang} object, for the
 * Estonian language.
 */

/**#@+
 @type String
 @example
 */

/**
 * Contains the dictionary of language entries.
 * @namespace
 */
CKEDITOR.lang['et'] =
{
    /**
     * The language reading direction. Possible values are "rtl" for
     * Right-To-Left languages (like Arabic) and "ltr" for Left-To-Right
     * languages (like English).
     * @default 'ltr'
     */
    dir: 'ltr',

    /*
     * Screenreader titles. Please note that screenreaders are not always capable
     * of reading non-English words. So be careful while translating it.
     */
    editorTitle: 'Vormindatud teksti redaktor %1',
    editorHelp: 'Abi saamiseks vajuta ALT 0',

    // ARIA descriptions.
    toolbars: 'Redaktori tööriistaribad',
    editor: 'Rikkalik tekstiredaktor',

    // Toolbar buttons without dialogs.
    source: 'Lähtekood',
    newPage: 'Uus leht',
    save: 'Salvestamine',
    preview: 'Eelvaade',
    cut: 'Lõika',
    copy: 'Kopeeri',
    paste: 'Aseta',
    print: 'Printimine',
    underline: 'Allajoonitud',
    bold: 'Paks',
    italic: 'Kursiiv',
    selectAll: 'Kõige valimine',
    removeFormat: 'Vormingu eemaldamine',
    strike: 'Läbijoonitud',
    subscript: 'Allindeks',
    superscript: 'Ülaindeks',
    horizontalrule: 'Horisontaaljoone sisestamine',
    pagebreak: 'Lehevahetuskoha sisestamine',
    pagebreakAlt: 'Lehevahetuskoht',
    unlink: 'Lingi eemaldamine',
    undo: 'Tagasivõtmine',
    redo: 'Toimingu kordamine',

    // Common messages and labels.
    common: {
        browseServer: 'Serveri sirvimine',
        url: 'URL',
        protocol: 'Protokoll',
        upload: 'Laadi üles',
        uploadSubmit: 'Saada serverisse',
        image: 'Pilt',
        flash: 'Flash',
        form: 'Vorm',
        checkbox: 'Märkeruut',
        radio: 'Raadionupp',
        textField: 'Tekstilahter',
        textarea: 'Tekstiala',
        hiddenField: 'Varjatud lahter',
        button: 'Nupp',
        select: 'Valiklahter',
        imageButton: 'Piltnupp',
        notSet: '<määramata>',
        id: 'ID',
        name: 'Nimi',
        langDir: 'Keele suund',
        langDirLtr: 'Vasakult paremale (LTR)',
        langDirRtl: 'Paremalt vasakule (RTL)',
        langCode: 'Keele kood',
        longDescr: 'Pikk kirjeldus URL',
        cssClass: 'Stiilistiku klassid',
        advisoryTitle: 'Soovituslik pealkiri',
        cssStyle: 'Laad',
        ok: 'OK',
        cancel: 'Loobu',
        close: 'Sulge',
        preview: 'Eelvaade',
        generalTab: 'Üldine',
        advancedTab: 'Täpsemalt',
        validateNumberFailed: 'See väärtus pole number.',
        confirmNewPage: 'Kõik salvestamata muudatused lähevad kaotsi. Kas oled kindel, et tahad laadida uue lehe?',
        confirmCancel: 'Mõned valikud on muudetud. Kas oled kindel, et tahad dialoogi sulgeda?',
        options: 'Valikud',
        target: 'Sihtkoht',
        targetNew: 'Uus aken (_blank)',
        targetTop: 'Kõige ülemine aken (_top)',
        targetSelf: 'Sama aken (_self)',
        targetParent: 'Vanemaken (_parent)',
        langDirLTR: 'Vasakult paremale (LTR)',
        langDirRTL: 'Paremalt vasakule (RTL)',
        styles: 'Stiili',
        cssClasses: 'Stiililehe klassid',
        width: 'Laius',
        height: 'Kõrgus',
        align: 'Joondus',
        alignLeft: 'Vasak',
        alignRight: 'Paremale',
        alignCenter: 'Kesk',
        alignTop: 'Üles',
        alignMiddle: 'Keskele',
        alignBottom: 'Alla',
        invalidValue: 'Invalid value.', // MISSING
        invalidHeight: 'Kõrgus peab olema number.',
        invalidWidth: 'Laius peab olema number.',
        invalidCssLength: '"%1" välja jaoks määratud väärtus peab olema positiivne täisarv CSS ühikuga (px, %, in, cm, mm, em, ex, pt või pc) või ilma.',
        invalidHtmlLength: '"%1" välja jaoks määratud väärtus peab olema positiivne täisarv HTML ühikuga (px või %) või ilma.',
        invalidInlineStyle: 'Reasisese stiili määrangud peavad koosnema paarisväärtustest (tuples), mis on semikoolonitega eraldatult järgnevas vormingus: "nimi : väärtus".',
        cssLengthTooltip: 'Sisesta väärtus pikslites või number koos sobiva CSS-i ühikuga (px, %, in, cm, mm, em, ex, pt või pc).',

        // Put the voice-only part of the label in the span.
        unavailable: '%1<span class="cke_accessibility">, pole saadaval</span>'
    },

    contextmenu: {
        options: 'Kontekstimenüü valikud'
    },

    // Special char dialog.
    specialChar: {
        toolbar: 'Erimärgi sisestamine',
        title: 'Erimärgi valimine',
        options: 'Erimärkide valikud'
    },

    // Link dialog.
    link: {
        toolbar: 'Lingi lisamine/muutmine',
        other: '<muu>',
        menu: 'Muuda linki',
        title: 'Link',
        info: 'Lingi info',
        target: 'Sihtkoht',
        upload: 'Lae üles',
        advanced: 'Täpsemalt',
        type: 'Lingi liik',
        toUrl: 'URL',
        toAnchor: 'Ankur sellel lehel',
        toEmail: 'E-post',
        targetFrame: '<raam>',
        targetPopup: '<hüpikaken>',
        targetFrameName: 'Sihtmärk raami nimi',
        targetPopupName: 'Hüpikakna nimi',
        popupFeatures: 'Hüpikakna omadused',
        popupResizable: 'Suurust saab muuta',
        popupStatusBar: 'Olekuriba',
        popupLocationBar: 'Aadressiriba',
        popupToolbar: 'Tööriistariba',
        popupMenuBar: 'Menüüriba',
        popupFullScreen: 'Täisekraan (IE)',
        popupScrollBars: 'Kerimisribad',
        popupDependent: 'Sõltuv (Netscape)',
        popupLeft: 'Vasak asukoht',
        popupTop: 'Ülemine asukoht',
        id: 'ID',
        langDir: 'Keele suund',
        langDirLTR: 'Vasakult paremale (LTR)',
        langDirRTL: 'Paremalt vasakule (RTL)',
        acccessKey: 'Juurdepääsu võti',
        name: 'Nimi',
        langCode: 'Keele suund',
        tabIndex: 'Tab indeks',
        advisoryTitle: 'Juhendav tiitel',
        advisoryContentType: 'Juhendava sisu tüüp',
        cssClasses: 'Stiilistiku klassid',
        charset: 'Lingitud ressursi märgistik',
        styles: 'Laad',
        rel: 'Suhe',
        selectAnchor: 'Vali ankur',
        anchorName: 'Ankru nime järgi',
        anchorId: 'Elemendi id järgi',
        emailAddress: 'E-posti aadress',
        emailSubject: 'Sõnumi teema',
        emailBody: 'Sõnumi tekst',
        noAnchors: '(Selles dokumendis pole ankruid)',
        noUrl: 'Palun kirjuta lingi URL',
        noEmail: 'Palun kirjuta e-posti aadress'
    },

    // Anchor dialog
    anchor: {
        toolbar: 'Ankru sisestamine/muutmine',
        menu: 'Ankru omadused',
        title: 'Ankru omadused',
        name: 'Ankru nimi',
        errorName: 'Palun sisesta ankru nimi',
        remove: 'Eemalda ankur'
    },

    // List style dialog
    list: {
        numberedTitle: 'Numberloendi omadused',
        bulletedTitle: 'Punktloendi omadused',
        type: 'Liik',
        start: 'Algus',
        validateStartNumber: 'Loendi algusnumber peab olema täisarv.',
        circle: 'Ring',
        disc: 'Täpp',
        square: 'Ruut',
        none: 'Puudub',
        notset: '<pole määratud>',
        armenian: 'Armeenia numbrid',
        georgian: 'Gruusia numbrid (an, ban, gan, jne)',
        lowerRoman: 'Väiksed rooma numbrid (i, ii, iii, iv, v, jne)',
        upperRoman: 'Suured rooma numbrid (I, II, III, IV, V, jne)',
        lowerAlpha: 'Väiketähed (a, b, c, d, e, jne)',
        upperAlpha: 'Suurtähed (A, B, C, D, E, jne)',
        lowerGreek: 'Kreeka väiketähed (alpha, beta, gamma, jne)',
        decimal: 'Numbrid (1, 2, 3, jne)',
        decimalLeadingZero: 'Numbrid algusnulliga (01, 02, 03, jne)'
    },

    // Find And Replace Dialog
    findAndReplace: {
        title: 'Otsimine ja asendamine',
        find: 'Otsi',
        replace: 'Asenda',
        findWhat: 'Otsitav:',
        replaceWith: 'Asendus:',
        notFoundMsg: 'Otsitud teksti ei leitud.',
        findOptions: 'Otsingu valikud',
        matchCase: 'Suur- ja väiketähtede eristamine',
        matchWord: 'Ainult terved sõnad',
        matchCyclic: 'Jätkatakse algusest',
        replaceAll: 'Asenda kõik',
        replaceSuccessMsg: '%1 vastet asendati.'
    },

    // Table Dialog
    table: {
        toolbar: 'Tabel',
        title: 'Tabeli omadused',
        menu: 'Tabeli omadused',
        deleteTable: 'Kustuta tabel',
        rows: 'Read',
        columns: 'Veerud',
        border: 'Joone suurus',
        widthPx: 'pikslit',
        widthPc: 'protsenti',
        widthUnit: 'laiuse ühik',
        cellSpace: 'Lahtri vahe',
        cellPad: 'Lahtri täidis',
        caption: 'Tabeli tiitel',
        summary: 'Kokkuvõte',
        headers: 'Päised',
        headersNone: 'Puudub',
        headersColumn: 'Esimene tulp',
        headersRow: 'Esimene rida',
        headersBoth: 'Mõlemad',
        invalidRows: 'Ridade arv peab olema nullist suurem.',
        invalidCols: 'Tulpade arv peab olema nullist suurem.',
        invalidBorder: 'Äärise suurus peab olema number.',
        invalidWidth: 'Tabeli laius peab olema number.',
        invalidHeight: 'Tabeli kõrgus peab olema number.',
        invalidCellSpacing: 'Lahtrite vahe peab olema positiivne arv.',
        invalidCellPadding: 'Lahtrite polsterdus (padding) peab olema positiivne arv.',

        cell: {
            menu: 'Lahter',
            insertBefore: 'Sisesta lahter enne',
            insertAfter: 'Sisesta lahter peale',
            deleteCell: 'Eemalda lahtrid',
            merge: 'Ühenda lahtrid',
            mergeRight: 'Ühenda paremale',
            mergeDown: 'Ühenda alla',
            splitHorizontal: 'Poolita lahter horisontaalselt',
            splitVertical: 'Poolita lahter vertikaalselt',
            title: 'Lahtri omadused',
            cellType: 'Lahtri liik',
            rowSpan: 'Ridade vahe',
            colSpan: 'Tulpade vahe',
            wordWrap: 'Sõnade murdmine',
            hAlign: 'Horisontaalne joondus',
            vAlign: 'Vertikaalne joondus',
            alignBaseline: 'Baasjoon',
            bgColor: 'Tausta värv',
            borderColor: 'Äärise värv',
            data: 'Andmed',
            header: 'Päis',
            yes: 'Jah',
            no: 'Ei',
            invalidWidth: 'Lahtri laius peab olema number.',
            invalidHeight: 'Lahtri kõrgus peab olema number.',
            invalidRowSpan: 'Ridade vahe peab olema täisarv.',
            invalidColSpan: 'Tulpade vahe peab olema täisarv.',
            chooseColor: 'Vali'
        },

        row: {
            menu: 'Rida',
            insertBefore: 'Sisesta rida enne',
            insertAfter: 'Sisesta rida peale',
            deleteRow: 'Eemalda read'
        },

        column: {
            menu: 'Veerg',
            insertBefore: 'Sisesta veerg enne',
            insertAfter: 'Sisesta veerg peale',
            deleteColumn: 'Eemalda veerud'
        }
    },

    // Button Dialog.
    button: {
        title: 'Nupu omadused',
        text: 'Tekst (väärtus)',
        type: 'Liik',
        typeBtn: 'Nupp',
        typeSbm: 'Saada',
        typeRst: 'Lähtesta'
    },

    // Checkbox and Radio Button Dialogs.
    checkboxAndRadio: {
        checkboxTitle: 'Märkeruudu omadused',
        radioTitle: 'Raadionupu omadused',
        value: 'Väärtus',
        selected: 'Märgitud'
    },

    // Form Dialog.
    form: {
        title: 'Vormi omadused',
        menu: 'Vormi omadused',
        action: 'Toiming',
        method: 'Meetod',
        encoding: 'Kodeering'
    },

    // Select Field Dialog.
    select: {
        title: 'Valiklahtri omadused',
        selectInfo: 'Info',
        opAvail: 'Võimalikud valikud:',
        value: 'Väärtus',
        size: 'Suurus',
        lines: 'ridu',
        chkMulti: 'Võimalik mitu valikut',
        opText: 'Tekst',
        opValue: 'Väärtus',
        btnAdd: 'Lisa',
        btnModify: 'Muuda',
        btnUp: 'Üles',
        btnDown: 'Alla',
        btnSetValue: 'Määra vaikimisi',
        btnDelete: 'Kustuta'
    },

    // Textarea Dialog.
    textarea: {
        title: 'Tekstiala omadused',
        cols: 'Veerge',
        rows: 'Ridu'
    },

    // Text Field Dialog.
    textfield: {
        title: 'Tekstilahtri omadused',
        name: 'Nimi',
        value: 'Väärtus',
        charWidth: 'Laius (tähemärkides)',
        maxChars: 'Maksimaalselt tähemärke',
        type: 'Liik',
        typeText: 'Tekst',
        typePass: 'Parool'
    },

    // Hidden Field Dialog.
    hidden: {
        title: 'Varjatud lahtri omadused',
        name: 'Nimi',
        value: 'Väärtus'
    },

    // Image Dialog.
    image: {
        title: 'Pildi omadused',
        titleButton: 'Piltnupu omadused',
        menu: 'Pildi omadused',
        infoTab: 'Pildi info',
        btnUpload: 'Saada serverisse',
        upload: 'Lae üles',
        alt: 'Alternatiivne tekst',
        lockRatio: 'Lukusta kuvasuhe',
        resetSize: 'Lähtesta suurus',
        border: 'Joon',
        hSpace: 'H. vaheruum',
        vSpace: 'V. vaheruum',
        alertUrl: 'Palun kirjuta pildi URL',
        linkTab: 'Link',
        button2Img: 'Kas tahad teisendada valitud pildiga nupu tavaliseks pildiks?',
        img2Button: 'Kas tahad teisendada valitud tavalise pildi pildiga nupuks?',
        urlMissing: 'Pildi lähte-URL on puudu.',
        validateBorder: 'Äärise laius peab olema täisarv.',
        validateHSpace: 'Horisontaalne vaheruum peab olema täisarv.',
        validateVSpace: 'Vertikaalne vaheruum peab olema täisarv.'
    },

    // Flash Dialog
    flash: {
        properties: 'Flashi omadused',
        propertiesTab: 'Omadused',
        title: 'Flashi omadused',
        chkPlay: 'Automaatne start ',
        chkLoop: 'Korduv',
        chkMenu: 'Flashi menüü lubatud',
        chkFull: 'Täisekraan lubatud',
        scale: 'Mastaap',
        scaleAll: 'Näidatakse kõike',
        scaleNoBorder: 'Äärist ei ole',
        scaleFit: 'Täpne sobivus',
        access: 'Skriptide ligipääs',
        accessAlways: 'Kõigile',
        accessSameDomain: 'Samalt domeenilt',
        accessNever: 'Mitte ühelegi',
        alignAbsBottom: 'Abs alla',
        alignAbsMiddle: 'Abs keskele',
        alignBaseline: 'Baasjoonele',
        alignTextTop: 'Tekstist üles',
        quality: 'Kvaliteet',
        qualityBest: 'Parim',
        qualityHigh: 'Kõrge',
        qualityAutoHigh: 'Automaatne kõrge',
        qualityMedium: 'Keskmine',
        qualityAutoLow: 'Automaatne madal',
        qualityLow: 'Madal',
        windowModeWindow: 'Aken',
        windowModeOpaque: 'Läbipaistmatu',
        windowModeTransparent: 'Läbipaistev',
        windowMode: 'Akna režiim',
        flashvars: 'Flashi muutujad',
        bgcolor: 'Tausta värv',
        hSpace: 'H. vaheruum',
        vSpace: 'V. vaheruum',
        validateSrc: 'Palun kirjuta lingi URL',
        validateHSpace: 'H. vaheruum peab olema number.',
        validateVSpace: 'V. vaheruum peab olema number.'
    },

    // Speller Pages Dialog
    spellCheck: {
        toolbar: 'Õigekirjakontroll',
        title: 'Õigekirjakontroll',
        notAvailable: 'Kahjuks ei ole teenus praegu saadaval.',
        errorLoading: 'Viga rakenduse teenushosti laadimisel: %s.',
        notInDic: 'Puudub sõnastikust',
        changeTo: 'Muuda',
        btnIgnore: 'Ignoreeri',
        btnIgnoreAll: 'Ignoreeri kõiki',
        btnReplace: 'Asenda',
        btnReplaceAll: 'Asenda kõik',
        btnUndo: 'Võta tagasi',
        noSuggestions: '- Soovitused puuduvad -',
        progress: 'Toimub õigekirja kontroll...',
        noMispell: 'Õigekirja kontroll sooritatud: õigekirjuvigu ei leitud',
        noChanges: 'Õigekirja kontroll sooritatud: ühtegi sõna ei muudetud',
        oneChange: 'Õigekirja kontroll sooritatud: üks sõna muudeti',
        manyChanges: 'Õigekirja kontroll sooritatud: %1 sõna muudetud',
        ieSpellDownload: 'Õigekirja kontrollija ei ole paigaldatud. Soovid sa selle alla laadida?'
    },

    smiley: {
        toolbar: 'Emotikon',
        title: 'Sisesta emotikon',
        options: 'Emotikonide valikud'
    },

    elementsPath: {
        eleLabel: 'Elementide asukoht',
        eleTitle: '%1 element'
    },

    numberedlist: 'Numberloend',
    bulletedlist: 'Punktloend',
    indent: 'Taande suurendamine',
    outdent: 'Taande vähendamine',

    justify: {
        left: 'Vasakjoondus',
        center: 'Keskjoondus',
        right: 'Paremjoondus',
        block: 'Rööpjoondus'
    },

    blockquote: 'Blokktsitaat',

    clipboard: {
        title: 'Asetamine',
        cutError: 'Sinu veebisirvija turvaseaded ei luba redaktoril automaatselt lõigata. Palun kasutage selleks klaviatuuri klahvikombinatsiooni (Ctrl/Cmd+X).',
        copyError: 'Sinu veebisirvija turvaseaded ei luba redaktoril automaatselt kopeerida. Palun kasutage selleks klaviatuuri klahvikombinatsiooni (Ctrl/Cmd+C).',
        pasteMsg: 'Palun aseta tekst järgnevasse kasti kasutades klaviatuuri klahvikombinatsiooni (<STRONG>Ctrl/Cmd+V</STRONG>) ja vajuta seejärel <STRONG>OK</STRONG>.',
        securityMsg: 'Sinu veebisirvija turvaseadete tõttu ei oma redaktor otsest ligipääsu lõikelaua andmetele. Sa pead asetama need uuesti siia aknasse.',
        pasteArea: 'Asetamise ala'
    },

    pastefromword: {
        confirmCleanup: 'Tekst, mida tahad asetada näib pärinevat Wordist. Kas tahad selle enne asetamist puhastada?',
        toolbar: 'Asetamine Wordist',
        title: 'Asetamine Wordist',
        error: 'Asetatud andmete puhastamine ei olnud sisemise vea tõttu võimalik'
    },

    pasteText: {
        button: 'Asetamine tavalise tekstina',
        title: 'Asetamine tavalise tekstina'
    },

    templates: {
        button: 'Mall',
        title: 'Sisumallid',
        options: 'Malli valikud',
        insertOption: 'Praegune sisu asendatakse',
        selectPromptMsg: 'Palun vali mall, mis avada redaktoris<br />(praegune sisu läheb kaotsi):',
        emptyListMsg: '(Ühtegi malli ei ole defineeritud)'
    },

    showBlocks: 'Blokkide näitamine',

    stylesCombo: {
        label: 'Stiil',
        panelTitle: 'Vormindusstiilid',
        panelTitle1: 'Blokkstiilid',
        panelTitle2: 'Reasisesed stiilid',
        panelTitle3: 'Objektistiilid'
    },

    format: {
        label: 'Vorming',
        panelTitle: 'Vorming',

        tag_p: 'Tavaline',
        tag_pre: 'Vormindatud',
        tag_address: 'Aadress',
        tag_h1: 'Pealkiri 1',
        tag_h2: 'Pealkiri 2',
        tag_h3: 'Pealkiri 3',
        tag_h4: 'Pealkiri 4',
        tag_h5: 'Pealkiri 5',
        tag_h6: 'Pealkiri 6',
        tag_div: 'Tavaline (DIV)'
    },

    div: {
        title: 'Div-konteineri loomine',
        toolbar: 'Div-konteineri loomine',
        cssClassInputLabel: 'Stiililehe klassid',
        styleSelectLabel: 'Stiil',
        IdInputLabel: 'ID',
        languageCodeInputLabel: ' Keelekood',
        inlineStyleInputLabel: 'Reasisene stiil',
        advisoryTitleInputLabel: 'Soovitatav pealkiri',
        langDirLabel: 'Keele suund',
        langDirLTRLabel: 'Vasakult paremale (LTR)',
        langDirRTLLabel: 'Paremalt vasakule (RTL)',
        edit: 'Muuda Div',
        remove: 'Eemalda Div'
    },

    iframe: {
        title: 'IFrame omadused',
        toolbar: 'IFrame',
        noUrl: 'Vali iframe URLi liik',
        scrolling: 'Kerimisribade lubamine',
        border: 'Raami äärise näitamine'
    },

    font: {
        label: 'Kiri',
        voiceLabel: 'Kiri',
        panelTitle: 'Kiri'
    },

    fontSize: {
        label: 'Suurus',
        voiceLabel: 'Kirja suurus',
        panelTitle: 'Suurus'
    },

    colorButton: {
        textColorTitle: 'Teksti värv',
        bgColorTitle: 'Tausta värv',
        panelTitle: 'Värvid',
        auto: 'Automaatne',
        more: 'Rohkem värve...'
    },

    colors: {
        '000': 'Must',
        '800000': 'Kastanpruun',
        '8B4513': 'Sadulapruun',
        '2F4F4F': 'Tume paehall',
        '008080': 'Sinakasroheline',
        '000080': 'Meresinine',
        '4B0082': 'Indigosinine',
        '696969': 'Tumehall',
        'B22222': 'Šamottkivi',
        'A52A2A': 'Pruun',
        'DAA520': 'Kuldkollane',
        '006400': 'Tumeroheline',
        '40E0D0': 'Türkiissinine',
        '0000CD': 'Keskmine sinine',
        '800080': 'Lilla',
        '808080': 'Hall',
        'F00': 'Punanae',
        'FF8C00': 'Tumeoranž',
        'FFD700': 'Kuldne',
        '008000': 'Roheline',
        '0FF': 'Tsüaniidsinine',
        '00F': 'Sinine',
        'EE82EE': 'Violetne',
        'A9A9A9': 'Tuhm hall',
        'FFA07A': 'Hele lõhe',
        'FFA500': 'Oranž',
        'FFFF00': 'Kollane',
        '00FF00': 'Lubja hall',
        'AFEEEE': 'Kahvatu türkiis',
        'ADD8E6': 'Helesinine',
        'DDA0DD': 'Ploomililla',
        'D3D3D3': 'Helehall',
        'FFF0F5': 'Lavendlipunane',
        'FAEBD7': 'Antiikvalge',
        'FFFFE0': 'Helekollane',
        'F0FFF0': 'Meloniroheline',
        'F0FFFF': 'Taevasinine',
        'F0F8FF': 'Beebisinine',
        'E6E6FA': 'Lavendel',
        'FFF': 'Valge'
    },

    scayt: {
        title: 'Õigekirjakontroll kirjutamise ajal',
        opera_title: 'Operas pole toetatud',
        enable: 'SCAYT lubatud',
        disable: 'SCAYT keelatud',
        about: 'SCAYT-ist lähemalt',
        toggle: 'SCAYT sisse/välja lülitamine',
        options: 'Valikud',
        langs: 'Keeled',
        moreSuggestions: 'Veel soovitusi',
        ignore: 'Eira',
        ignoreAll: 'Eira kõiki',
        addWord: 'Lisa sõna',
        emptyDic: 'Sõnaraamatu nimi ei tohi olla tühi.',

        optionsTab: 'Valikud',
        allCaps: 'Läbivate suurtähtedega sõnade eiramine',
        ignoreDomainNames: 'Domeeninimede eiramine',
        mixedCase: 'Tavapäratu tõstuga sõnade eiramine',
        mixedWithDigits: 'Numbreid sisaldavate sõnade eiramine',

        languagesTab: 'Keeled',

        dictionariesTab: 'Sõnaraamatud',
        dic_field_name: 'Sõnaraamatu nimi',
        dic_create: 'Loo',
        dic_restore: 'Taasta',
        dic_delete: 'Kustuta',
        dic_rename: 'Nimeta ümber',
        dic_info: 'Alguses säilitatakse kasutaja sõnaraamatut küpsises. Küpsise suurus on piiratud. Pärast sõnaraamatu kasvamist nii suureks, et see küpsisesse ei mahu, võib sõnaraamatut hoida meie serveris. Oma isikliku sõnaraamatu hoidmiseks meie serveris pead andma sellele nime. Kui sa juba oled sõnaraamatu salvestanud, sisesta selle nimi ja klõpsa taastamise nupule.',

        aboutTab: 'Lähemalt'
    },

    about: {
        title: 'CKEditorist',
        dlgTitle: 'CKEditorist',
        help: 'Abi jaoks vaata $1.',
        userGuide: 'CKEditori kasutusjuhendit',
        moreInfo: 'Litsentsi andmed leiab meie veebilehelt:',
        copy: 'Copyright &copy; $1. Kõik õigused kaitstud.'
    },

    maximize: 'Maksimeerimine',
    minimize: 'Minimeerimine',

    fakeobjects: {
        anchor: 'Ankur',
        flash: 'Flashi animatsioon',
        iframe: 'IFrame',
        hiddenfield: 'Varjatud väli',
        unknown: 'Tundmatu objekt'
    },

    resize: 'Suuruse muutmiseks lohista',

    colordialog: {
        title: 'Värvi valimine',
        options: 'Värvi valikud',
        highlight: 'Näidis',
        selected: 'Valitud värv',
        clear: 'Eemalda'
    },

    toolbarCollapse: 'Tööriistariba peitmine',
    toolbarExpand: 'Tööriistariba näitamine',

    toolbarGroups: {
        document: 'Dokument',
        clipboard: 'Lõikelaud/tagasivõtmine',
        editing: 'Muutmine',
        forms: 'Vormid',
        basicstyles: 'Põhistiilid',
        paragraph: 'Lõik',
        links: 'Lingid',
        insert: 'Sisesta',
        styles: 'Stiilid',
        colors: 'Värvid',
        tools: 'Tööriistad'
    },

    bidi: {
        ltr: 'Teksti suund vasakult paremale',
        rtl: 'Teksti suund paremalt vasakule'
    },

    docprops: {
        label: 'Dokumendi omadused',
        title: 'Dokumendi omadused',
        design: 'Disain',
        meta: 'Meta andmed',
        chooseColor: 'Vali',
        other: '<muu>',
        docTitle: 'Lehekülje tiitel',
        charset: 'Märgistiku kodeering',
        charsetOther: 'Ülejäänud märgistike kodeeringud',
        charsetASCII: 'ASCII',
        charsetCE: 'Kesk-Euroopa',
        charsetCT: 'Hiina traditsiooniline (Big5)',
        charsetCR: 'Kirillisa',
        charsetGR: 'Kreeka',
        charsetJP: 'Jaapani',
        charsetKR: 'Korea',
        charsetTR: 'Türgi',
        charsetUN: 'Unicode (UTF-8)',
        charsetWE: 'Lääne-Euroopa',
        docType: 'Dokumendi tüüppäis',
        docTypeOther: 'Teised dokumendi tüüppäised',
        xhtmlDec: 'Arva kaasa XHTML deklaratsioonid',
        bgColor: 'Taustavärv',
        bgImage: 'Taustapildi URL',
        bgFixed: 'Mittekeritav tagataust',
        txtColor: 'Teksti värv',
        margin: 'Lehekülje äärised',
        marginTop: 'Ülaserv',
        marginLeft: 'Vasakserv',
        marginRight: 'Paremserv',
        marginBottom: 'Alaserv',
        metaKeywords: 'Dokumendi võtmesõnad (eraldatud komadega)',
        metaDescription: 'Dokumendi kirjeldus',
        metaAuthor: 'Autor',
        metaCopyright: 'Autoriõigus',
        previewHtml: '<p>See on <strong>näidistekst</strong>. Sa kasutad <a href="javascript:void(0)">CKEditori</a>.</p>'
    }
};
