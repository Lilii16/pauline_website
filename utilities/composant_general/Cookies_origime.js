
    document.querySelector(".consent-modal-button").addEventListener(
        "click",
        function() {
            orejime.show();
        },
        false
    );

    document.querySelector(".reset-button").addEventListener(
        "click",
        function() {
            orejime.internals.manager.resetConsent();
            location.reload();
        },
        false
    );

    window.orejimeConfig = {
        elementID: "orejime",
        appElement: "#app",
        cookieName: "orejime",
        cookieExpiresAfterDays: 365,
        privacyPolicy: "http://pauline-website/mentions.php",
        default: !0,
        mustConsent: !0,
        mustNotice: !1,
        implicitConsent: !1,
        lang: "fr",
        logo: !0,
        debug: !1,
        translations: {
            fr: {
                consentModal: {
                    title: "Les informations que nous collectons",
                    description: "Bienvenue sur notre site web. Nous utilisons des cookies pour assurer le bon fonctionnement du site et pour permettre la gestion des demandes que vous nous envoyez via notre formulaire de contact. Si vous acceptez l’utilisation des cookies, vous pourrez toujours la désactiver ultérieurement. ",
                },
                consentNotice: {
                    title: "Politique des cookies",
                },
                purposes: {
                    analytics: "Analyse",
                    security: "Sécurité",
                },
            },
        },
        apps: [{
                name: "",
                title: "Cookie essentiel",
                description: "Ce cookie nous permet de surveiller l'activité sur notre site pour détecter et prévenir les menaces potentielles à la sécurité. Bien que sa finalité principale soit l'analyse, il joue également un rôle dans la sécurité lors de l'envoi des données des utilisateur.ices via le formulaire de contact.",
                cookies: [
                    "_ga",
                    "_gat",
                    "_gid",
                    "__utma",
                    "__utmb",
                    "__utmc",
                    "__utmt",
                    "__utmz",
                ],
                purposes: ["analytics", "security"],
                required: !1,
                optOut: !1,
                default: !0,
                onlyOnce: !0,
            },
        
            {
                name: "",
                title: "Les tierces parties",
                description: "Nous utilisons une plateforme de paiement externe pour sécuriser vos transactions. Cette plateforme peut installer des cookies tiers pour assurer le bon fonctionnement du processus de paiement et pour des raisons de sécurité. En donnant votre consentement ci-dessous, vous acceptez l'installation de ces cookies tiers sur votre appareil. Dans le cas de prise de rdv sur internet, la redirection se fera vers le site du Barreau de Marseille.",
                cookies: [
                    "_ga",
                    "_gat",
                    "_gid",
                    "__utma",
                    "__utmb",
                    "__utmc",
                    "__utmt",
                    "__utmz",
                ],
                purposes: ["analytics", "security"],
                required: !1,
                optOut: !1,
                default: !0,
                onlyOnce: !0,
            },
        ],
      };