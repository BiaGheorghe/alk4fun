alk4fun - Un Web IDE pentru Alk

Aplicațiile de tip cloud based IDE capătă proporții din ce în ce mai mari în ceea ce privește popularitatea în rândul programatorilor. Unul dintre motivele cărora se datorează acest fapt îl reprezintă faptul că nu mai este nevoie de setup, spre deosebire de aplicațiile desktop de acest tip.
IDE este abrevierea de la Integrated Development Environment. Web IDE, cunoscut de asemenea și sub denumirea de online IDE sau cloud IDE, este un mediu de dezvoltare integrat ce poate fi accesat dintr-un Browser precum Google Chrome, Firefox sau Microsoft Edge, permițând dezvoltarea de software pe dispozitive cu putere redusă care sunt în mod normal nepotrivite. Unul dintre cele mai importante avantaje este accesibilitatea. Ușurința cu care utilizatorii pot începe să lucreze este reprezentată de faptul că nu mai este necesară instalarea vreunui software. E este nevoie doar de conexiune la internet și un browser compatibil, aplicația putând fi accesată de pe orice dispozitiv precum PC, laptop sau chiar și tabletă sau smartphone. Siguranța datelor joacă de asemenea un rol important. Chiar dacă în majoritatea cazurilor dezvoltatorii folosesc version control atunci când lucrează cu aplicații de tip IDE desktop tradiționale, aceștia având permanent o copie a codului într-un repository, se poate întâmplă ca progresul făcut de la ultima versiune salvată pe cloud să se piardă. La polul opus, folosind aplicațiile web IDE, utilizatorii au mereu salvat în cloud progresul făcut și astfel nu există riscul pierderii datelor.

Alk este un limbaj algoritmic ce este utilizat în predarea structurilor de date și a algoritmilor. Acesta folosește o notație abstractizată pentru structurile de date, independenta de reprezentarea (implementarea) acestora in limbajele de programarea. Alk este executabil, având posibilitatea de a executa si fragmente de algoritmi. De asemenea, Alk vine însoțit și de un set de instrumente care ajută la analiză corectitudinii și eficienței algoritmilor. Scopul este acela de a fi un limbaj simplu și ușor de înțeles.

Având în vedere faptul că momentan nu există nicio aplicație web IDE care să poată compila scripturi scrise în limbajul Alk, am decis să creez o astfel de aplicație. alk4fun este o aplicație online IDE ce permite utilizatorilor aceleași facilități pe care le pot avea atunci când folosesc o aplicație de tip web IDE deja existenta, diferența constând în faptul că singurul limbaj acceptat este Alk.
Utilizatorii aplicațiilor sunt împărțiți în două categorii: utilizatori autentificați și utilizatorii neautentificați. Având în vedere faptul că utilizatorii neautentificați au acces la aceleași funcționalități precum utilizatorii autentificați, dar cu mici excepții, voi continuă prin enumerarea funcționalităților utilizatorilor neautentificați și apoi pe ale utilizatorilor autentificați fără a le repeta: 

a. Utilizatorul neautentificat are acces la următoarele funcționalități cu mențiunea că proiectele vor fi șterse după 6 ore din momentul accesării aplicației: 
• Își poate crea un cont. 
• Poate accesa pagina de “Home” a aplicației in care poate adăuga, edita, salva sau rula codul din terminal si in care poate vedea de asemenea si rezultatul rulării in zona de output.
• Poate accesa pagina “My projects” unde poate vedea toate proiectele, poate crea sau încărca de pe disc proiecte noi in repository-ul temporar si poate deschide, șterge, redenumi sau descărca local proiectele deja existente în listă . 
• La proiectul deschis poate adăuga fișiere și directoare noi, iar pentru fișierele și directoarele deja existente utilizatorul are posibilitatea de a le șterge sau redenumi, aceste funcționalități fiind posibile prin implementarea unui meniu custom pe right-click. 
• Poate selecta la rulare mai mulți parametri: Input file, Input text, Precision, Metadata, Exhaustive mode, Path condition, Static verification, Smt sau version. 
• Fișierele cu extensia “.in” pot fi folosite drept fișiere de intrare si pot fi create de către utilizator in proiect sau încărcate de pe disc.

b. Utilizatorul autentificat, in plus față de cel neautentificat, are în permanență acces la proiecte, indiferent de cât de mult timp a trecut de la deschiderea sesiunii. 

Pentru a alege limbajele de programare, am luat în considerare, în primul rând, tipul aplicației. Având în vedere faptul că aplicația dezvoltată este de tip web, lista cu posibile limbaje și medii de lucru a fost redusă substanțial. În al doilea rând, inevitabilele probleme ce apar de-a lungul dezvoltării aplicației au o rată mult mai mare de rezolvare dacă este inclus și factorul comunităților online. Prin urmare am ales următoarele tehnologii: 
•	Tehnologii backend: 
PHP - Hypertext Preprocessor - este un limbaj popular de scripting de uz general, care este potrivit în special pentru dezvoltarea web. Rapid, flexibil și pragmatic, PHP sta la baza a orice, de la bloguri, la cele mai populare site-uri web din lume.

•	Tehnologii frontend: 
HTML - HyperText Markup Language - stă la baza dezvoltării frontend. Este folosit pentru a structura o pagină web și conținutul acesteia și constă într-o serie de elemente pentru a încadra diferite părți ale conținutului, făcându-l să arate sau să acționeze într-un anumit fel.
CSS - Cascading Style Sheet - este un limbaj bazat pe style sheets folosit pentru a descrie prezentarea unui document scris în HTML sau XML si descrie modul în care elementele ar trebui să fie redate pe ecran, pe pagină, în vorbire sau pe alte medii. Din aceste considerente am folosit CSS împreună cu framework-ul Bootstrap pentru a reda modul in care sunt afișate in pagina elementele HTML. 
JavaScript cu jQuery si Ajax - JavaScript este un limbaj de programare care a fost, este și va fi una dintre cele mai importante tehnologii frontend. Acest lucru permite modificarea în mod dinamic a conținutului aplicației sau website-ului.

• Baza de date 
MySQL este unul dintre cele mai utilizate sisteme de gestionare a bazelor de date relaționale open source. Pentru alk4fun am decis să folosesc o singură bază de date MySql ce conține informații despre credentialele utilizatorilor înregistrați: numele de utilizator, email-ul și parola criptată prin folosirea unui puternic algoritm hash unidirecțional.

În urma testării aplicației de către un grup de 5 potențiali utilizatori, rezultatele au arătat că majoritatea așteptărilor au fost satisfăcute de aplicație. Aceștia au concluzionat că aplicația este intuitivă și ușor de folosit. De asemenea alk4fun a fost asemănat cu Visual Studio Code, tranziția de la un alt editor de cod la aplicația online fiind ușoară. 

În concluzie, alk4fun și-a îndeplinit scopul, acela de a fi o aplicație web IDE ce poate să ruleze cod scris în limbajul Alk. 
