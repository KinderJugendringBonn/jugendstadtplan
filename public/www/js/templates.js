angular.module("jugendstadtplan.templates", []).run(["$templateCache", function($templateCache) {$templateCache.put("app/startseite/views/startseite.tpl.html","<div class=\"big-map-container\">\n    <div class=\"angular-leaflet-map\">\n        <leaflet markers=\"markers\" defaults=\"defaults\" center=\"center\"></leaflet>\n    </div>\n</div>");
$templateCache.put("app/termin/views/form.tpl.html","<fieldset data-ng-controller=\"TerminFormController\">\n    <legend>Termine</legend>\n    <div>\n        <p>Bisher</p>\n        <ul>\n            <li data-ng-repeat=\"termin in model.termine\">\n                <p>{{ termin.beginn | date:\'dd.MM.yyyy\' }}</p>\n                <p>{{ termin.beginn_uhrzeit | date:\'HH.mm\' }}</p>\n                <p>{{ termin.ende | date:\'dd.MM.yyyy\' }}</p>\n                <p>{{ termin.ende_uhrzeit | date:\'HH.mm\' }}</p>\n                <ul>\n                    <li data-ng-repeat=\"wiederholung in termin.wiederholungen\">\n                        <p>{{ wiederholung.wochentag }}</p>\n                        <p data-ng-if=\"wiederholung.woche_des_monats == 0\">Jede Woche</p>\n                        <p data-ng-if=\"wiederholung.woche_des_monats != 0\">Jede {{ wiederholung.woche_des_monats }}. Woche</p>\n                        <p data-ng-if=\"wiederholung.auch_an_feiertagen\">Auch an Feiertagen</p>\n                        <p data-ng-if=\"wiederholung.auch_in_den_ferien\">Auch in den Ferien</p>\n                    </li>\n                </ul>\n            </li>\n        </ul>\n        <p>Neuen Termin anlegen:</p>\n        <div class=\"row\">\n            <div class=\"large-4 columns\">\n                <label for=\"termin.beginn\">Beginn*:</label>\n                <input id=\"termin.beginn\" type=\"date\" data-ng-model=\"newTermin.beginn\" required />\n            </div>\n        </div>\n        <div class=\"row\">\n            <div class=\"large-8 columns\">\n                <div class=\"switch small\">\n                    <span>Ganztägig</span>\n                    <input id=\"termin.ganztaegig\" type=\"checkbox\" data-ng-model=\"newTermin.ganztaegig\" />\n                    <label for=\"termin.ganztaegig\"></label>\n                </div>\n            </div>\n        </div>\n        <div data-ng-show=\"!newTermin.ganztaegig\" class=\"row\">\n            <div class=\"large-4 columns\">\n                <label for=\"termin.beginn_uhrzeit\">Uhrzeit:</label>\n                <input id=\"termin.beginn_uhrzeit\" type=\"time\" data-ng-model=\"newTermin.beginn_uhrzeit\" />\n            </div>\n        </div>\n        <div class=\"row\">\n            <div class=\"large-4 columns\">\n                <label for=\"termin.ende\">Ende:</label>\n                <input id=\"termin.ende\" type=\"date\" data-ng-model=\"newTermin.ende\" />\n            </div>\n        </div>\n        <div data-ng-show=\"!newTermin.ganztaegig\" class=\"row\">\n            <div class=\"large-8 columns\">\n                <label for=\"termin.ende_uhrzeit\">Endzeit:</label>\n                <input id=\"termin.ende_uhrzeit\" type=\"time\" data-ng-model=\"newTermin.ende_uhrzeit\" />\n            </div>\n        </div>\n        <div>\n            <p>Dieser Termin wiederholt sich:</p>\n            <ul>\n                <li data-ng-repeat=\"wiederholung in newTermin.wiederholungen\">\n                    <p>{{ wiederholung.wochentag }}</p>\n                    <p data-ng-if=\"wiederholung.woche_des_monats == 0\">Jede Woche</p>\n                    <p data-ng-if=\"wiederholung.woche_des_monats != 0\">Jede {{ wiederholung.woche_des_monats }}. Woche</p>\n                    <p data-ng-if=\"wiederholung.auch_an_feiertagen == true\">Auch an Feiertagen</p>\n                    <p data-ng-if=\"wiederholung.auch_in_den_ferien == true\">Auch in den Ferien</p>\n                </li>\n            </ul>\n            <fieldset>\n                <legend>Wiederholung</legend>\n                <div class=\"row\">\n                    <div class=\"large-4 columns\">\n                        <label for=\"termin.wiederholung.wochentag\">Wochentag</label>\n                        <select id=\"termin.wiederholung.wochentag\" data-ng-model=\"newWiederholung.wochentag\" data-ng-options=\"wochentag for wochentag in wochentage\" required class=\"tiny dropdown\"></select>\n                    </div>\n                </div>\n                <div class=\"row\">\n                    <div class=\"large-4 columns\">\n                        <label for=\"termin.wiederholung.woche_des_monats\">Wiederholung</label>\n                        <select id=\"termin.wiederholung.woche_des_monats\" data-ng-model=\"newWiederholung.woche_des_monats\" data-ng-options=\"woche.id as woche.label for woche in woche_des_monats\" class=\"tiny dropdown\"></select>\n                    </div>\n                </div>\n                <div class=\"row\">\n                    <div class=\"large-8 columns\">\n                        <div class=\"switch small\">\n                            <span>Auch an Feiertagen</span>\n                            <input id=\"termin.wiederholung.auch_an_feiertagen\" type=\"checkbox\" data-ng-model=\"newWiederholung.auch_an_feiertagen\" />\n                            <label for=\"termin.wiederholung.auch_an_feiertagen\"></label>\n                        </div>\n                    </div>\n                </div>\n                <div class=\"row\">\n                    <div class=\"large-8 columns\">\n                        <div class=\"switch small\">\n                            <span>Auch in den Ferien</span>\n                            <input id=\"termin.wiederholung.auch_in_den_ferien\" type=\"checkbox\" data-ng-model=\"newWiederholung.auch_in_den_ferien\" />\n                            <label for=\"termin.wiederholung.auch_in_den_ferien\"></label>\n                        </div>\n                    </div>\n                </div>\n                <button type=\"button\" data-ng-click=\"addWiederholung()\" data-ng-disabled=\"!isWiederholungValid(newWiederholung)\" class=\"tiny button\">Wiederholung hinzufügen</button>\n            </fieldset>\n        </div>\n        <button type=\"button\" data-ng-click=\"addTermin()\" data-ng-disabled=\"!isTerminValid(newTermin)\" class=\"small button\">Termin hinzufügen</button>\n    </div>\n</fieldset>");
$templateCache.put("app/pins/views/detail.tpl.html","<div class=\"row-fluid\">\n    <h1 class=\"page-header\">Pin {{ pin.titel }}</h1>\n    <small>{{ pin.kategorie.name }}</small>\n\n    <div data-ng-bind-html=\"pin.beschreibung\"></div>\n\n    <div data-ng-if=\"pin.adresse !== undefined\">\n        <h2>Adresse:</h2>\n        <p>{{ pin.adresse.strasse }}</p>\n        <p>{{ pin.adresse.plz }}</p>\n        <p>{{ pin.adresse.ort }}</p>\n    </div>\n\n    <div data-ng-if=\"pin.barrierefreiheit !== undefined\">\n        <h2>Barrierefreiheit</h2>\n        <p>{{ pin.barrierefreiheit }}</p>\n    </div>\n\n    <div data-ng-if=\"pin.kosten_art !== undefined\">\n        <h2>Kosten</h2>\n        <p>{{ pin.kosten_art }}</p>\n        <p data-ng-if=\"pin.kosten_bemerkung !== undefined\">{{ pin.kosten_bemerkung }}</p>\n    </div>\n\n    <div data-ng-if=\"pin.anmeldepflichtig !== undefined\">\n        <h2>Anmeldepflicht</h2>\n        <p data-ng-show=\"pin.anmeldepflichtig\">Vorherige Anmeldung erforderlich</p>\n        <p data-ng-hide=\"pin.anmeldepflichtig\">Keine vorherige Anmeldung erforderlich</p>\n        <p data-ng-if=\"pin.anmeldepflicht_bemerkung !== undefined\">{{ pin.anmeldepflicht_bemerkung }}</p>\n    </div>\n\n    <div data-ng-if=\"pin.mindestalter !== undefined\">\n        <h2>Mindestalter</h2>\n        <p>{{ pin.mindestalter }}</p>\n    </div>\n\n    <div data-ng-if=\"pin.ansprechpartner.length !== 0\">\n        <h2>Ansprechpartner:</h2>\n        <ul>\n            <li data-ng-repeat=\"ansprechpartner in pin.ansprechpartner\">\n                <p>{{ ansprechpartner.name }}</p>\n                <small data-ng-if=\"ansprechpartner.telefonnummer\">Fon: {{ ansprechpartner.telefonnummer }}</small>\n                <small data-ng-if=\"ansprechpartner.mobilnummer\">Mobil: {{ ansprechpartner.mobilnummer }}</small>\n                <small data-ng-if=\"ansprechpartner.email\">E-Mail: {{ ansprechpartner.email }}</small>\n            </li>\n        </ul>\n    </div>\n\n    <div data-ng-if=\"pin.termine.length !== 0\">\n        <h2>Termine</h2>\n        <ul>\n            <li data-ng-repeat=\"termin in pin.termine\">\n                <p data-ng-if=\"!termin.ganztaegig\">{{ termin.beginn | date:\'dd.MM.yyyy HH:mm\' }} Uhr</p>\n                <p data-ng-if=\"termin.ganztaegig\">{{ termin.beginn | date:\'dd.MM.yyyy\' }}</p>\n                <p data-ng-if=\"!termin.ganztaegig\">{{ termin.ende | date:\'dd.MM.yyyy HH:mm\' }} Uhr</p>\n                <p data-ng-if=\"termin.ganztaegig\">{{ termin.ende | date:\'dd.MM.yyyy\' }}</p>\n                <ul>\n                    <li data-ng-repeat=\"wiederholung in termin.wiederholungen\">\n                        <p>{{ wiederholung.wochentag }}</p>\n                        <p data-ng-if=\"wiederholung.woche_des_monats === 0\">Jede Woche</p>\n                        <p data-ng-if=\"wiederholung.woche_des_monats !== 0\">Jede {{ wiederholung.woche_des_monats }}. Woche</p>\n                        <p data-ng-if=\"wiederholung.auch_an_feiertagen\">Auch an Feiertagen</p>\n                        <p data-ng-if=\"wiederholung.auch_in_den_ferien\">Auch in den Ferien</p>\n                    </li>\n                </ul>\n            </li>\n        </ul>\n    </div>\n\n    <div data-ng-if=\"pin.links.length !== 0\">\n        <h2>Links:</h2>\n        <ul>\n            <li data-ng-repeat=\"link in pin.links\">\n                <a data-ng-href=\"{{ link.url }}\">{{ link.titel }}</a>\n            </li>\n        </ul>\n    </div>\n\n    <div class=\"small-map-container\">\n        <div class=\"angular-leaflet-map\">\n            <leaflet markers=\"markers\" defaults=\"defaults\" center=\"center\"></leaflet>\n        </div>\n    </div>\n \n</div>");
$templateCache.put("app/pins/views/form.tpl.html","<div>\n    <h3>Bisherige Pins:</h3>\n    <ul data-ng-show=\"pins.length\">\n        <li data-ng-repeat=\"pin in pins | orderBy: \'titel\'\">\n            <div data-ng-click=\"setActivePin(pin)\">\n                <h2>{{ pin.titel }}</h2>\n                <small>{{ pin.traeger.titel }}</small>\n                <small data-ng-bind-html=\"pin.beschreibung\"></small>\n            </div>\n            <button class=\"btn btn-danger\" data-ng-click=\"remove(pin, $index)\">Löschen</button>\n        </li>\n    </ul>\n\n    <form data-ng-submit=\"save(pin)\" novalidate=\"novalidate\">\n        <fieldset>\n            <legend>Stammdaten</legend>\n            <div class=\"row\">\n                <div class=\"large-8 columns\">\n                    <label for=\"pin.titel\">Titel</label>\n                    <input id=\"pin.titel\" type=\"text\" data-ng-model=\"pin.titel\" />\n                </div>\n            </div>\n            <div class=\"row\">\n                <div class=\"large-8 columns\">\n                    <label for=\"pin.traeger\">Träger</label>\n                    <select id=\"pin.traeger\" data-ng-model=\"pin.traeger\" data-ng-options=\"traeger.id as traeger.titel for traeger in traegers\" class=\"tiny dropdown\"></select>\n                </div>\n            </div>\n            <div class=\"row\">\n                <div class=\"large-8 columns\">\n                    <label for=\"pin.kategorie\">Kategorie</label>\n                    <select id=\"pin.kategorie\" data-ng-model=\"pin.kategorie\" data-ng-options=\"kategorie.id as kategorie.name for kategorie in kategorien\" class=\"tiny dropdown\"></select>\n                </div>\n            </div>\n        </fieldset>\n        <fieldset>\n            <legend>Adresse</legend>\n            <div>\n                <label for=\"pin.adresse.strasse\">Straße / Hausnummer:</label>\n                <input id=\"pin.adresse.strasse\" type=\"text\" data-ng-model=\"pin.adresse.strasse\" />\n                <label for=\"pin.adresse.plz\">PLZ:</label>\n                <input id=\"pin.adresse.plz\" type=\"text\" data-ng-model=\"pin.adresse.plz\" />\n                <label for=\"pin.adresse.ort\">Ort:</label>\n                <input id=\"pin.adresse.ort\" type=\"text\" data-ng-model=\"pin.adresse.ort\" />\n            </div>\n        </fieldset>\n        <fieldset>\n            <legend>Details</legend>\n            <div class=\"row\">\n                <div class=\"large-8 columns\">\n                    <label for=\"pin.barrierefreiheit\">Barrierefreiheit</label>\n                    <select id=\"pin.barrierefreiheit\" data-ng-model=\"pin.barrierefreiheit\" data-ng-options=\"barrierefreiheit for barrierefreiheit in barrierefreiheitsgrade\" class=\"tiny dropdown\"></select>\n                </div>\n            </div>\n            <div class=\"row\">\n                <div class=\"large-8 columns\">\n                    <label for=\"pin.kostenart\">Kostenart</label>\n                    <select id=\"pin.kostenart\" data-ng-model=\"pin.kostenart\" data-ng-options=\"kostenart for kostenart in kostenarten\" class=\"tiny dropdown\"></select>\n                </div>\n            </div>\n            <div class=\"row\">\n                <div class=\"large-12 columns\">\n                    <label for=\"pin.kostenbemerkung\">Bemerkungen zu den Kosten</label>\n                    <textarea id=\"pin.kostenbemerkung\" data-ng-model=\"pin.kostenbemerkung\"></textarea>\n                </div>\n            </div>\n            <div class=\"row\">\n                <div class=\"large-8 columns\">\n                    <div class=\"switch small\">\n                        <span>Anmeldepflichtig</span>\n                        <input id=\"pin.anmeldepflichtig\" type=\"checkbox\" data-ng-model=\"pin.anmeldepflichtig\" />\n                        <label for=\"pin.anmeldepflichtig\"></label>\n                    </div>\n                </div>\n            </div>\n            <div class=\"row\">\n                <div class=\"large-12 columns\">\n                    <label for=\"pin.anmeldepflichtbemerkung\">Bemerkungen zur Anmeldepflicht</label>\n                    <textarea id=\"pin.anmeldepflichtbemerkung\" data-ng-model=\"pin.anmeldepflichtbemerkung\"></textarea>\n                </div>\n            </div>\n            <div class=\"row\">\n                <div class=\"large-8 columns\">\n                    <label for=\"pin.mindestalter\">Mindestalter</label>\n                    <select id=\"pin.mindestalter\" data-ng-model=\"pin.mindestalter\" data-ng-options=\"mindestalter for mindestalter in mindestalters\" class=\"tiny dropdown\"></select>\n                </div>\n            </div>\n        </fieldset>\n\n        <ng-include src=\"\'app/ansprechpartner/views/form.tpl.html\'\" data-ng-init=\"model = pin\"></ng-include>\n\n        <ng-include src=\"\'app/termin/views/form.tpl.html\'\" data-ng-init=\"model = pin\"></ng-include>\n\n        <fieldset>\n            <legend>Beschreibung</legend>\n            <text-angular data-ng-model=\"pin.beschreibung\"></text-angular>\n        </fieldset>\n        <fieldset>\n            <legend>Pin platzieren</legend>\n            <div class=\"small-map-container\">\n                <leaflet defaults=\"defaults\" center=\"center\" markers=\"pin.markers\" event-broadcast=\"events\"></leaflet>\n            </div>\n            <div class=\"hidden\">\n                <label for=\"kjrb_jugendstadtplanbundle_pin_longitude\" class=\"required\">Longitude</label>\n                <input type=\"text\" id=\"kjrb_jugendstadtplanbundle_pin_longitude\" data-ng-model=\"pin.markers[0].lng\"/>\n            </div>\n            <div class=\"hidden\">\n                <label for=\"kjrb_jugendstadtplanbundle_pin_latitude\" class=\"required\">Latitude</label>\n                <input type=\"text\" id=\"kjrb_jugendstadtplanbundle_pin_latitude\" data-ng-model=\"pin.markers[0].lat\" />\n            </div>\n        </fieldset>\n\n        <ng-include src=\"\'app/links/views/form.tpl.html\'\" data-ng-init=\"model = pin\"></ng-include>\n\n        <ul class=\"button-group\">\n            <li>\n                <button type=\"submit\" class=\"button\">Pin speichern</button>\n            </li>\n            <li>\n                <button data-ng-if=\"editing\" class=\"button secondary\" data-ng-click=\"newPin()\">Neuen Pin anlegen</button>\n            </li>\n        </ul>\n    </form>\n</div>");
$templateCache.put("app/pins/views/list.tpl.html","<div class=\"row-fluid\">\n  <h1 class=\"page-header\">\n    Pins\n    <small>Hier geht was ab in Bonn.</small>\n  </h1>\n\n  <ul>\n    <li data-ng-repeat=\"pin in pins | orderBy: \'titel\'\" data-ng-click=\"viewPin(pin)\">\n        <a href=\"#/pin/{{pin.id}}\">\n            <h2>{{ pin.titel }}</h2>\n        </a>\n        <small data-ng-bind-html=\"pin.beschreibung\"></small>\n    </li>\n  </ul>\n \n</div>");
$templateCache.put("app/traeger/views/detail.tpl.html","<div class=\"row-fluid\">\n    <h1 class=\"page-header\">Traeger {{ traeger.titel }}</h1>\n    <small>Hauptsächlich tätig in: {{ traeger.kategorie.name }}</small>\n\n    <div data-ng-bind-html=\"traeger.beschreibung\"></div>\n\n    <div data-ng-if=\"traeger.ansprechpartner.length !== 0\">\n        <h2>Ansprechpartner:</h2>\n        <ul>\n            <li data-ng-repeat=\"ansprechpartner in traeger.ansprechpartner\">\n                <p>{{ ansprechpartner.name }}</p>\n                <small data-ng-if=\"ansprechpartner.telefonnummer\">Fon: {{ ansprechpartner.telefonnummer }}</small>\n                <small data-ng-if=\"ansprechpartner.mobilnummer\">Mobil: {{ ansprechpartner.mobilnummer }}</small>\n                <small data-ng-if=\"ansprechpartner.email\">E-Mail: {{ ansprechpartner.email }}</small>\n            </li>\n        </ul>\n    </div>\n\n    <div data-ng-if=\"traeger.adressen.length !== 0\">\n        <h2>Adressen:</h2>\n        <ul>\n            <li data-ng-repeat=\"adresse in traeger.adressen\">\n                <p>{{ adresse.strasse }}</p>\n                <p>{{ adresse.plz }}</p>\n                <p>{{ adresse.ort }}</p>\n            </li>\n        </ul>\n    </div>\n\n    <div data-ng-if=\"traeger.links.length !== 0\">\n        <h2>Links:</h2>\n        <ul>\n            <li data-ng-repeat=\"link in traeger.links\">\n                <a data-ng-href=\"{{ link.url }}\">{{ link.titel }}</a>\n            </li>\n        </ul>\n    </div>\n\n    <div class=\"small-map-container\">\n        <div class=\"angular-leaflet-map\">\n            <leaflet markers=\"markers\" defaults=\"defaults\" center=\"center\"></leaflet>\n        </div>\n    </div>\n \n</div>");
$templateCache.put("app/traeger/views/form.tpl.html","<div>\n    <h3>Bisherige Träger:</h3>\n    <ul data-ng-show=\"traegers.length\">\n        <li data-ng-repeat=\"traeger in traegers | orderBy: \'titel\'\">\n            <div data-ng-click=\"setActiveTraeger(traeger)\">\n                <h2>{{ traeger.titel }}</h2>\n                <small data-ng-bind-html=\"traeger.beschreibung\"></small>\n            </div>\n            <button class=\"btn btn-danger\" data-ng-click=\"remove(traeger, $index)\">Löschen</button>\n        </li>\n    </ul>\n\n    <form data-ng-submit=\"save(traeger)\" novalidate=\"novalidate\">\n        <fieldset>\n            <legend>Login-Daten</legend>\n            <div class=\"row\">\n                <div class=\"large-8 columns\">\n                    <label for=\"traeger.email\">Email</label>\n                    <input id=\"traeger.email\" type=\"text\" data-ng-model=\"traeger.email\" required />\n                </div>\n            </div>\n            <div class=\"row\">\n                <div class=\"large-8 columns\">\n                    <label for=\"traeger.passwort\">Passwort</label>\n                    <input id=\"traeger.passwort\" type=\"password\" data-ng-model=\"traeger.passwort\" required />\n                </div>\n            </div>\n        </fieldset>\n\n        <fieldset>\n            <legend>Stammdaten</legend>\n            <div class=\"row\">\n                <div class=\"large-8 columns\">\n                    <label for=\"traeger.kategorie\">Kategorie</label>\n                    <select id=\"traeger.kategorie\" data-ng-model=\"traeger.kategorie\" data-ng-options=\"kategorie.id as kategorie.name for kategorie in kategorien\" class=\"tiny dropdown\"></select>\n                </div>\n            </div>\n            <div class=\"row\">\n                <div class=\"large-8 columns\">\n                    <label for=\"traeger.titel\">Titel</label>\n                    <input id=\"traeger.titel\" type=\"text\" data-ng-model=\"traeger.titel\" required />\n                </div>\n            </div>\n        </fieldset>\n\n        <ng-include src=\"\'app/ansprechpartner/views/form.tpl.html\'\" data-ng-init=\"model = traeger\"></ng-include>\n\n        <fieldset>\n            <legend>Adressen</legend>\n            <div>\n                <p>Bisher</p>\n                <ul>\n                    <li data-ng-repeat=\"adresse in traeger.adressen\">\n                        <p>{{ adresse.strasse }}</p>\n                        <p>{{ adresse.plz }}</p>\n                        <p>{{ adresse.ort }}</p>\n                    </li>\n                </ul>\n                <p>Neue Adresse anlegen:</p>\n                <div class=\"row\">\n                    <div class=\"large-8 columns\">\n                        <label for=\"traeger.adresse.strasse\">Straße / Hausnummer*:</label>\n                        <input id=\"traeger.adresse.strasse\" type=\"text\" data-ng-model=\"newAdresse.strasse\" required />\n                    </div>\n                </div>\n                <div class=\"row\">\n                    <div class=\"large-4 columns\">\n                        <label for=\"traeger.adresse.plz\">PLZ:</label>\n                        <input id=\"traeger.adresse.plz\" type=\"text\" data-ng-model=\"newAdresse.plz\" />\n                    </div>\n                </div>\n                <div class=\"row\">\n                    <div class=\"large-8 columns\">\n                        <label for=\"traeger.adresse.ort\">Ort*:</label>\n                        <input id=\"traeger.adresse.ort\" type=\"text\" data-ng-model=\"newAdresse.ort\" />\n                    </div>\n                </div>\n                <button type=\"button\" data-ng-click=\"addAdresse()\" data-ng-disabled=\"!isAdresseValid(newAdresse)\">Hinzufügen</button>\n            </div>\n        </fieldset>\n\n        <ng-include src=\"\'app/links/views/form.tpl.html\'\" data-ng-init=\"model = traeger\"></ng-include>\n\n        <fieldset>\n            <legend>Bilder</legend>\n                <input type=\"file\" data-ng-file-select=\"onFileSelect($files)\" multiple>\n                <button data-ng-click=\"upload.abort()\">Cancel Upload</button>\n        </fieldset>\n        <fieldset>\n            <legend>Beschreibung</legend>\n            <text-angular data-ng-model=\"traeger.beschreibung\"></text-angular>\n        </fieldset>\n        <button type=\"submit\" class=\"btn btn-primary\">Träger speichern</button>\n    </form>\n    <button data-ng-if=\"editing\" class=\"btn btn-success\" data-ng-click=\"newTraeger()\">Neuen Träger anlegen</button>\n</div>");
$templateCache.put("app/traeger/views/liste.tpl.html","<div class=\"row-fluid\">\n  <h1 class=\"page-header\">\n    Träger\n    <small>Diese Träger gibt es in Bonn.</small>\n  </h1>\n\n  <ul>\n    <li data-ng-repeat=\"currentTraeger in traeger | orderBy: \'titel\'\" data-ng-click=\"viewTraeger(currentTraeger)\">\n        <a href=\"#/traeger/{{currentTraeger.id}}\">\n            <h2>{{ currentTraeger.titel }}</h2>\n        </a>\n      <small data-ng-bind-html=\"currentTraeger.beschreibung\"></small>\n    </li>\n  </ul>\n \n</div>");
$templateCache.put("app/traeger/views/login.tpl.html","<form data-ng-submit=\"login(traeger)\" novalidate=\"novalidate\">\n    <fieldset>\n        <legend>Login</legend>\n        <div class=\"row\">\n            <div class=\"large-8 columns\">\n                <label for=\"traeger.email\">Email</label>\n                <input id=\"traeger.email\" type=\"text\" data-ng-model=\"traeger.email\" required />\n            </div>\n        </div>\n        <div class=\"row\">\n            <div class=\"large-8 columns\">\n                <label for=\"traeger.password\">Passwort</label>\n                <input id=\"traeger.password\" type=\"password\" data-ng-model=\"traeger.password\" required />\n            </div>\n        </div>\n        <button type=\"submit\" class=\"btn btn-primary\">Einloggen</button>\n    </fieldset>\n</form>");
$templateCache.put("app/traeger/views/logout.tpl.html","<button ng-click=\"logout()\">Logout</button>");
$templateCache.put("app/links/views/form.tpl.html","<fieldset data-ng-controller=\"LinksFormController\">\n    <legend>Links</legend>\n    <div>\n        <p>Bisher</p>\n        <ul>\n            <li data-ng-repeat=\"link in model.links\">\n                <a data-ng-href=\"{{ link.url }}\">{{ link.titel }}</a>\n            </li>\n        </ul>\n        <p>Link hinzufügen:</p>\n        <div class=\"row\">\n            <div class=\"large-8 columns\">\n                <label for=\"link.titel\">Titel*:</label>\n                <input id=\"link.titel\" type=\"text\" data-ng-model=\"newLink.titel\" />\n            </div>\n        </div>\n        <div class=\"row\">\n            <div class=\"large-8 columns\">\n                <label for=\"link.url\">URL*:</label>\n                <input id=\"link.url\" type=\"url\" data-ng-model=\"newLink.url\" />\n            </div>\n        </div>\n        <button type=\"button\" data-ng-click=\"addLink()\" data-ng-disabled=\"!isLinkValid(newLink)\">Hinzufügen</button>\n    </div>\n</fieldset>");
$templateCache.put("app/ansprechpartner/views/form.tpl.html","<fieldset data-ng-controller=\"AnsprechpartnerFormController\">\n    <legend>Ansprechpartner</legend>\n    <div>\n        <p>Bisher</p>\n        <ul>\n            <li data-ng-repeat=\"ansprechpartner in model.ansprechpartner\">\n                <p>{{ ansprechpartner.name }}</p>\n                <small>{{ ansprechpartner.telefonnummer }}</small>\n                <small>{{ ansprechpartner.mobilnummer }}</small>\n                <small>{{ ansprechpartner.email }}</small>\n            </li>\n        </ul>\n        <p>Neuen Ansprechpartner anlegen:</p>\n        <div class=\"row\">\n            <div class=\"large-8 columns\">\n                <label for=\"ansprechpartner.name\">Name*:</label>\n                <input id=\"ansprechpartner.name\" type=\"text\" data-ng-model=\"newAnsprechpartner.name\" required />\n            </div>\n        </div>\n        <div class=\"row\">\n            <div class=\"large-8 columns\">\n                <label for=\"ansprechpartner.telefonnummer\">Telefonnummer:</label>\n                <input id=\"ansprechpartner.telefonnummer\" type=\"tel\" data-ng-model=\"newAnsprechpartner.telefonnummer\" />\n            </div>\n        </div>\n        <div class=\"row\">\n            <div class=\"large-8 columns\">\n                <label for=\"ansprechpartner.mobilnummer\">Handy:</label>\n                <input id=\"ansprechpartner.mobilnummer\" type=\"tel\" data-ng-model=\"newAnsprechpartner.mobilnummer\" />\n            </div>\n        </div>\n        <div class=\"row\">\n            <div class=\"large-8 columns\">\n                <label for=\"ansprechpartner.email\">EMail*:</label>\n                <input id=\"ansprechpartner.email\" type=\"email\" data-ng-model=\"newAnsprechpartner.email\" required />\n            </div>\n        </div>\n        <div class=\"row\">\n            <div class=\"large-8 columns\">\n                <label for=\"traeger.ansprechpartner.bemerkung\">Bemerkungen:</label>\n                <textarea id=\"traeger.ansprechpartner.bemerkung\" data-ng-model=\"newAnsprechpartner.bemerkung\"></textarea>\n            </div>\n        </div>\n        <button type=\"button\" data-ng-click=\"addAnsprechpartner()\" data-ng-disabled=\"!isAnsprechpartnerValid(newAnsprechpartner)\">Hinzufügen</button>\n    </div>\n</fieldset>");}]);