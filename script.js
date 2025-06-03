document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll(".game-card");
    cards.forEach(card => {
        card.addEventListener("click", () => {
            const gameId = card.dataset.gameId;
            if (gameId) {
                window.location.href = `game-detail.html?game=${gameId}`;
            }
        });
    });
});
