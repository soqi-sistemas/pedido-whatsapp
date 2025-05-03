
let carrinho = [];

function showTab(tab) {
  document.getElementById("cardapio").style.display = tab === "cardapio" ? "block" : "none";
  document.getElementById("promocoes").style.display = tab === "promocoes" ? "block" : "none";
}

function addItem(nome, preco) {
  carrinho.push({ nome, preco });
  alert(`${nome} adicionado ao carrinho!`);
}

function addPizzaPersonalizada() {
  const tamanho = document.getElementById("pizzaTamanho").value;
  const sabores = document.getElementById("pizzaSabores").value;
  const precos = {
    media: 40.9,
    grande: 46.9,
    familia: 59.9,
    superfamilia: 69.9
  };
  const nome = `Pizza ${tamanho} - ${sabores}`;
  const preco = precos[tamanho];
  addItem(nome, preco);
}

function viewCart() {
  const modal = document.getElementById("cartModal");
  const list = document.getElementById("cartItems");
  const total = document.getElementById("cartTotal");
  list.innerHTML = "";
  let valorTotal = 0;
  carrinho.forEach((item, index) => {
    valorTotal += item.preco;
    list.innerHTML += `<li>${item.nome} - R$ ${item.preco.toFixed(2)}</li>`;
  });
  total.innerText = valorTotal.toFixed(2);
  modal.classList.remove("hidden");
}

function closeCart() {
  document.getElementById("cartModal").classList.add("hidden");
}

function sendWhatsApp() {
  if (carrinho.length === 0) return alert("Seu carrinho está vazio.");
  let mensagem = "Olá, gostaria de fazer um pedido:%0A";
  let total = 0;
  carrinho.forEach(item => {
    mensagem += `- ${item.nome} - R$ ${item.preco.toFixed(2)}%0A`;
    total += item.preco;
  });
  mensagem += `%0ATotal: R$ ${total.toFixed(2)}`;
  const numero = "SEU_NUMERO_AQUI"; // Coloque o número com DDD e sem + (ex: 5591999999999)
  window.open(`https://wa.me/${numero}?text=${mensagem}`, "_blank");
}

