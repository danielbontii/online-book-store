DROP TABLE IF EXISTS books;
CREATE TABLE books
(
    id          serial PRIMARY KEY,
    title       VARCHAR(100),
    author      VARCHAR(50),
    price       FLOAT,
    description TEXT,
    keywords    VARCHAR(255),
    cover       VARCHAR(255),
    featured    INTEGER DEFAULT 0,
    category    VARCHAR(50)
);

INSERT INTO `books` (`title`,
                     `author`,
                     `cover`,
                     `description`,
                     `price`,
                     `keywords`,
                     `category`)
VALUES ('Learning Mobile App Development',
        'Jakob Iversen, Michael Eierman',
        'uploads/mobile_app.jpg',
        'Now, one book can help you master mobile app development with both market-leading platforms: Apple''s iOS and Google''s Android. Perfect for both students and professionals, Learning Mobile App Development is the only tutorial with complete parallel coverage of both iOS and Android. With this guide, you can master either platform, or both - and gain a deeper understanding of the issues associated with developing mobile apps.\r\n\r\nYou''ll develop an actual working app on both iOS and Android, mastering the entire mobile app development lifecycle, from planning through licensing and distribution.\r\n\r\nEach tutorial in this book has been carefully designed to support readers with widely varying backgrounds and has been extensively tested in live developer training courses. If you''re new to iOS, you''ll also find an easy, practical introduction to Objective-C, Apple''s native language.',
        '20.00',
        'mobile, app development',
        'App development'),
       ('Doing Good By Doing Good',
        'Peter Baines',
        'uploads/doing_good.jpg',
        'Doing Good by Doing Good shows companies how to improve the bottom line by implementing an engaging, authentic, and business-enhancing program that helps staff and business thrive. International CSR consultant Peter Baines draws upon lessons learnt from the challenges faced in his career as a police officer, forensic investigator, and founder of Hands Across the Water to describe the Australian CSR landscape, and the factors that make up a program that benefits everyone involved. Case studies illustrate the real effect of CSR on both business and society, with clear guidance toward maximizing involvement, engaging all employees, and improving the bottom line. The case studies draw out the companies that are focusing on creating shared value in meeting the challenges of society whilst at the same time bringing strong economic returns.\r\n\r\nConsumers are now expecting that big businesses with ever-increasing profits give back to the community from which those profits arise. At the same time, shareholders are demanding their share and are happy to see dividends soar. Getting this right is a balancing act, and Doing Good by Doing Good helps companies delineate a plan of action for getting it done.',
        '20.00',
        'business, improvement',
        'Business'),
       ('Programmable Logic Controllers',
        'Dag H. Hanssen',
        'uploads/logic_program.jpg',
        'Widely used across industrial and manufacturing automation, Programmable Logic Controllers (PLCs) perform a broad range of electromechanical tasks with multiple input and output arrangements, designed specifically to cope in severe environmental conditions such as automotive and chemical plants.Programmable Logic Controllers: A Practical Approach using CoDeSys is a hands-on guide to rapidly gain proficiency in the development and operation of PLCs based on the IEC 61131-3 standard. Using the freely-available* software tool CoDeSys, which is widely used in industrial design automation projects, the author takes a highly practical approach to PLC design using real-world examples. The design tool, CoDeSys, also features a built in simulator / soft PLC enabling the reader to undertake exercises and test the examples.',
        '20.00',
        'programming, logic, controllers',
        'Programming'),
       ('Professional JavaScript for Web Developers, 3rd Edition',
        'Nicholas C. Zakas',
        'uploads/pro_js.jpg',
        'If you want to achieve JavaScript''s full potential, it is critical to understand its nature, history, and limitations. To that end, this updated version of the bestseller by veteran author and JavaScript guru Nicholas C. Zakas covers JavaScript from its very beginning to the present-day incarnations including the DOM, Ajax, and HTML5. Zakas shows you how to extend this powerful language to meet specific needs and create dynamic user interfaces for the web that blur the line between desktop and internet. By the end of the book, you''ll have a strong understanding of the significant advances in web development as they relate to JavaScript so that you can apply them to your next website.',
        '30.00',
        'Javascript, programming',
        'Javascript'),
       ('Learning Web App Development',
        'Semmy Purewal',
        'uploads/web_app_dev.jpg',
        'Grasp the fundamentals of web application development by building a simple database-backed app from scratch, using HTML, JavaScript, and other open source tools. Through hands-on tutorials, this practical guide shows inexperienced web app developers how to create a user interface, write a server, build client-server communication, and use a cloud-based service to deploy the application.\r\n\r\nEach chapter includes practice problems, full examples, and mental models of the development workflow. Ideal for a college-level course, this book helps you get started with web app development by providing you with a solid grounding in the process.',
        '20.00',
        'html, javascript, database',
        'Web Development'),
       ('Beautiful JavaScript',
        'Anton Kovalyov',
        'uploads/beauty_js.jpg',
        'JavaScript is arguably the most polarizing and misunderstood programming language in the world. Many have attempted to replace it as the language of the Web, but JavaScript has survived, evolved, and thrived. Why did a language created in such hurry succeed where others failed?\r\n\r\nThis guide gives you a rare glimpse into JavaScript from people intimately familiar with it. Chapters contributed by domain experts such as Jacob Thornton, Ariya Hidayat, and Sara Chipps show what they love about their favorite language - whether it''s turning the most feared features into useful tools, or how JavaScript can be used for self-expression.',
        '20.00',
        'javascript',
        'JavaScript'),
       ('Professional ASP.NET 4 in C# and VB',
        'Scott Hanselman',
        'uploads/pro_asp4.jpg',
        'ASP.NET is about making you as productive as possible when building fast and secure web applications. Each release of ASP.NET gets better and removes a lot of the tedious code that you previously needed to put in place, making common ASP.NET tasks easier. With this book, an unparalleled team of authors walks you through the full breadth of ASP.NET and the new and exciting capabilities of ASP.NET 4. The authors also show you how to maximize the abundance of features that ASP.NET offers to make your development process smoother and more efficient.',
        '20.00',
        '.net, c#',
        'C#'),
       ('Android Studio New Media Fundamentals',
        'Wallace Jackson',
        'uploads/android_studio.jpg',
        'Android Studio New Media Fundamentals is a new media primer covering concepts central to multimedia production for Android including digital imagery, digital audio, digital video, digital illustration and 3D, using open source software packages such as GIMP, Audacity, Blender, and Inkscape. These professional software packages are used for this book because they are free for commercial use. The book builds on the foundational concepts of raster, vector, and waveform (audio), and gets more advanced as chapters progress, covering what new media assets are best for use with Android Studio as well as key factors regarding the data footprint optimization work process and why new media content and new media data optimization is so important.',
        '35.52',
        'android',
        'Android Development'),
       ('C++ 14 Quick Syntax Reference, 2nd Edition',
        '	Mikael Olsson',
        'uploads/c_14_quick.jpg',
        'This updated handy quick C++ 14 guide is a condensed code and syntax reference based on the newly updated C++ 14 release of the popular programming language. It presents the essential C++ syntax in a well-organized format that can be used as a handy reference.\r\n\r\nYou won''t find any technical jargon, bloated samples, drawn out history lessons, or witty stories in this book. What you will find is a language reference that is concise, to the point and highly accessible. The book is packed with useful information and is a must-have for any C++ programmer.\r\n\r\nIn the C++ 14 Quick Syntax Reference, Second Edition, you will find a concise reference to the C++ 14 language syntax. It has short, simple, and focused code examples. This book includes a well laid out table of contents and a comprehensive index allowing for easy review.',
        '20.00',
        'c++, reference',
        'C++'),
       ('C# 6.0 in a Nutshell, 6th Edition',
        'Joseph Albahari, Ben Albahari',
        'uploads/c_sharp_6.jpg',
        'When you have questions about C# 6.0 or the .NET CLR and its core Framework assemblies, this bestselling guide has the answers you need. C# has become a language of unusual flexibility and breadth since its premiere in 2000, but this continual growth means there''s still much more to learn.\r\n\r\nOrganized around concepts and use cases, this thoroughly updated sixth edition provides intermediate and advanced programmers with a concise map of C# and .NET knowledge. Dive in and discover why this Nutshell guide is considered the definitive reference on C#.',
        '20.00',
        'c#, summary, .net',
        'C#');

DROP TABLE IF EXISTS users;
CREATE TABLE users
(
    id       serial PRIMARY KEY,
    username VARCHAR(50) UNIQUE,
    password VARCHAR(255),
    role     VARCHAR(10)
);

INSERT INTO `users` (`id`, `username`, `password`, `role`)
VALUES (1, 'admin', '$2y$10$vPEruAUZjJWZHObjXwv5iu6Opr34Ib6w1Iunac4Wmgw6g3XJob8jy', 'admin'),
       (2, 'user', '$2y$10$le93VYd/G1fUX6k42vZEXOzvTUHqGjpbt.YflVpAWlU2Y0fU.h63e', 'user');

DROP TABLE IF EXISTS reviews;
CREATE TABLE reviews
(
    id      serial PRIMARY KEY,
    book_id INTEGER REFERENCES books (id),
    user_id INTEGER REFERENCES users (id),
    review  VARCHAR(255)
);

DROP TABLE IF EXISTS carts;
CREATE TABLE carts
(
    id         serial PRIMARY KEY,
    book_id    INTEGER REFERENCES books (id),
    user_id    INTEGER REFERENCES users (id),
    quantity   INTEGER,
    total_cost FLOAT,
    confirmed  INTEGER DEFAULT 0
);

DROP TABLE IF EXISTS comments;
CREATE TABLE comments
(
    id      serial PRIMARY KEY,
    book_id INTEGER REFERENCES books (id),
    user_id INTEGER REFERENCES users (id),
    message VARCHAR(255)
);

DROP TABLE IF EXISTS replies;
CREATE TABLE replies
(
    id         serial PRIMARY KEY,
    comment_id INTEGER REFERENCES comments (id),
    user_id    INTEGER REFERENCES users (id),
    message    VARCHAR(255)
);


-- TODO: extract categories and authors to separate tables