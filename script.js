/* script.js - simple interactivity for forms and devotion */

document.addEventListener('DOMContentLoaded', function(){
  // Devotion: simple set of verses
    const verses = [
    {v:"John 3:16", t:"For God so loved the world, that he gave his only begotten Son..."},
    {v:"Psalm 46:1", t:"God is our refuge and strength, a very present help in trouble."},
    {v:"Philippians 4:13", t:"I can do all things through Christ which strengtheneth me."},
    {v:"Romans 8:28", t:"All things work together for good to them that love God."},
    {v:"Proverbs 3:5", t:"Trust in the LORD with all thine heart; and lean not unto thine own understanding."}
    ];
    const verseEl = document.querySelector('.verse');
    const reflEl = document.querySelector('.reflection');
    const newVerseBtn = document.getElementById('new-verse-btn');

    function showRandomVerse(){
    if(!verseEl || !reflEl) return;
    const i = Math.floor(Math.random()*verses.length);
    verseEl.textContent = verses[i].v + " —";
    reflEl.textContent = verses[i].t;
    }
    showRandomVerse();
    if(newVerseBtn) newVerseBtn.addEventListener('click', showRandomVerse);

  // Event registration (client-only)
    const eventForm = document.getElementById('event-form');
    if(eventForm){
    eventForm.addEventListener('submit', function(e){
        e.preventDefault();
        const name = this.elements['name'].value.trim();
        const email = this.elements['email'].value.trim();
        const eventName = this.elements['event'].value;
        if(!name || !email){
        alert("Please fill name and email.");
        return;
        }
        alert(`Thanks ${name}! You've registered for "${eventName}".`);
        this.reset();
    });
    }

  // Prayer form
    const prayerForm = document.getElementById('prayer-form');
    if(prayerForm){
    prayerForm.addEventListener('submit', function(e){
        e.preventDefault();
        const name = this.elements['name'].value.trim() || "Friend";
        alert(`Thank you, ${name}! Your prayer request has been submitted.`);
        this.reset();
    });
    }

  // Contact form
    const contactForm = document.getElementById('contact-form');
    if(contactForm){
        contactForm.addEventListener('submit', function(e){
        e.preventDefault();
        alert("Thank you! We'll get back to you soon.");
        this.reset();
    });
    }
});
