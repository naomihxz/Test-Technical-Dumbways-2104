from math import floor 

class Product:
    def __init__(self, id, name, price, quantity=0):
        self.id = id
        self.name = name
        self.price = price
        self.quantity = quantity


class Money:
    def __init__(self, nom, tipe, trans):
        self.nom = nom
        self.tipe = tipe
        self.trans = trans
        self.quantity = 0

    def __str__(self):
        return "{} {} Rp. {} ({})".format(self.quantity, self.tipe, self.nom, self.trans)


class VendingMachine:
    def __init__(self, id):
        self.id = id

        p1 = Product(1, "Coca-cola", 4000)
        p2 = Product(2, "Fanta", 3500)
        p3 = Product(3, "Pepsi", 4500)

        self.list_product = [p1, p2, p3]
        self.total_price = 0

        m1 = Money(50000, "Lembar uang", "Lima Puluh Ribu Rupiah")
        m2 = Money(20000, "Lembar uang", "Dua Puluh Ribu Rupiah")
        m3 = Money(10000, "Lembar uang", "Sepuluh Puluh Ribu Rupiah")
        m4 = Money(5000, "Lembar uang", "Lima Ribu Rupiah")
        m5 = Money(2000, "Lembar uang", "Dua Ribu Rupiah")
        m6 = Money(1000, "Lembar uang", "Seribu Rupiah")
        m7 = Money(500, "Uang coin", "Lima Ratus Rupiah")

        self.list_mon = [m1, m2, m3, m4, m5, m6, m7]

    def buy_product(self, id, q):
        for e in self.list_product:
            if e.id == id:
                e.quantity += q
                self.total_price += q * e.price
                break
        else:
            print("Product tidak ditemukan")

    def get_change(self, mon_ins):
        return mon_ins - self.total_price

    def reset(self):
        for m in self.list_mon:
            m.quantity = 0
        self.total_price = 0

    def checkout(self, mon_ins):
        change = self.get_change(mon_ins)
        if change > 0:
            print("Kembalian:")
            for m in self.list_mon:
                if change >= m.nom:
                    x = floor(change / m.nom)
                    m.quantity = x
                    change -= x * m.nom
                    print(m)   
            self.reset()

        else:
            print("Maaf uang anda tidak cukup")


# fungsi main
if __name__ == "__main__":
    V =  VendingMachine(1)
    V.buy_product(1, 2)
    V.buy_product(3, 1)

    mon_ins = 50000

    x = Money(V.get_change(mon_ins), "", "Tiga Puluh Tujuh Ribu Lima Ratus Rupiah")
    V.checkout(mon_ins)

    print("Total kembalian Rp.{} ({})".format(x.nom, x.trans))
   