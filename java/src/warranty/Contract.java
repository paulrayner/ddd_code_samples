package warranty;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;

import warranty.Claim;

public class Contract {

	public Contract(int id, double d) {
		this.purchasePrice = d;
		this.status = Status.PENDING;
	}

	public int id;
	public double purchasePrice;
	public Date effectiveDate = new Date();
	public Date expirationDate = new Date();
	public Date purchaseDate = new Date();
	public int inStoreGuaranteeDays;
	public Status status;
	public Product product;
	
    public enum Status { PENDING, ACTIVE, EXPIRED }
	
    private List<Claim> Claims = new ArrayList<Claim>();

    public void add(Claim Claim)
    {
        Claims.add(Claim);
    }

    public List<Claim> getClaims()
    {
        return Claims; 
    }

    public void remove(Claim Claim)
    {
        Claims.remove(Claim);
    }
}
