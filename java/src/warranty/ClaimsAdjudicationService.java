package warranty;

import java.util.ArrayList;
import java.util.List;

import warranty.Contract.Status;

public class ClaimsAdjudicationService {

	public void Adjudicate(Contract contract, Claim newClaim) {
		double claimTotal = 0;
		List<Claim> claims = new ArrayList<Claim>();
		claims.addAll(contract.getClaims());
		
		for (Claim claim:claims)
		{
			claimTotal += claim.amount;
		}
		
		if (((contract.purchasePrice - claimTotal) * 0.8 > newClaim.amount) &&
				(newClaim.date.compareTo(contract.effectiveDate) >= 0) &&
				(newClaim.date.compareTo(contract.expirationDate) <= 0) &&
			  	(contract.status == Status.ACTIVE)) {
			contract.add(newClaim);
		}
	}
}
