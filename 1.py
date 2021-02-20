# fungsi untuk menentukan bilangan prima dengan range
# yang telah ditentukan. 
def prime_between(from_num, until_num):
    primes = list()

    for num in range(from_num, until_num):
        for i in range(2, num):
            if num % i == 0:
                break
        else:
            primes.append(num)

    return primes

# fungsi untuk menampilkan list bilangan beserta jumlah elemen
def print_primes(primes):
    print("Jumlah bilangan prima : {}".format(len(primes)))
    for e in primes:
        print("+ {}".format(e))


# fungsi main
if __name__ == "__main__":
    print_primes(prime_between(20, 50))