public function insertProduct($name, $price, $stock) {
    $stmt = $this->pdo->prepare("INSERT INTO products (name, price, stock) VALUES (?, ?, ?)");
    return $stmt->execute([$name, $price, $stock]);
}