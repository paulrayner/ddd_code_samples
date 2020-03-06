package warranty;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import org.junit.Test;

import warranty.Contract.Status;

import junit.framework.Assert;

public class TestClaimsAdjudication {

	@Test
	public void testClaimsAdjudication() throws ParseException
	{
		SimpleDateFormat sourceFormat = new SimpleDateFormat("MM-dd-yyyy");

		Contract contract = new Contract(999, 100.0);
		contract.effectiveDate = sourceFormat.parse("08-05-2010");
		contract.expirationDate = sourceFormat.parse("08-05-2012");
		contract.status = Status.ACTIVE;

		Claim claim = new Claim(888, 79.0, sourceFormat.parse("08-05-2010"));

		ClaimsAdjudicationService adjudicator = new ClaimsAdjudicationService();
		
		adjudicator.Adjudicate(contract, claim);
        
		Assert.assertEquals(1, contract.getClaims().size());
	}
	

	@Test
	public void testClaimsAdjudicationForInvalidClaim() throws ParseException
	{
		SimpleDateFormat sourceFormat = new SimpleDateFormat("MM-dd-yyyy");

		Contract contract = new Contract(999, 100.0);
		contract.effectiveDate = sourceFormat.parse("08-05-2010");
		contract.expirationDate = sourceFormat.parse("08-05-2012");
		contract.status = Status.ACTIVE;

		Claim claim = new Claim(888, 81.0, sourceFormat.parse("08-05-2010"));

		ClaimsAdjudicationService adjudicator = new ClaimsAdjudicationService();

		adjudicator.Adjudicate(contract, claim);
        
		Assert.assertEquals(0, contract.getClaims().size());
	}
	
	@Test
	public void testClaimsAdjudicationForPendingContract() throws ParseException
	{
		SimpleDateFormat sourceFormat = new SimpleDateFormat("MM-dd-yyyy");

		Claim claim = new Claim(888, 81.0, sourceFormat.parse("08-05-2010"));

		Contract pendingContract = new Contract(999, 100.0);
		pendingContract.effectiveDate = sourceFormat.parse("08-05-2010");
		pendingContract.expirationDate = sourceFormat.parse("08-05-2012");
		pendingContract.status = Status.PENDING;

		ClaimsAdjudicationService adjudicator = new ClaimsAdjudicationService();
		
		adjudicator.Adjudicate(pendingContract, claim);
        
		Assert.assertEquals(0, pendingContract.getClaims().size());
	}
	
	@Test
	public void testClaimsAdjudicationForExpiredContract() throws ParseException
	{
		SimpleDateFormat sourceFormat = new SimpleDateFormat("MM-dd-yyyy");

		Claim claim = new Claim(888, 79.0, sourceFormat.parse("08-05-2010"));

		Contract pendingContract = new Contract(999, 100.0);
		pendingContract.effectiveDate = sourceFormat.parse("08-05-2010");
		pendingContract.expirationDate = sourceFormat.parse("08-05-2012");
		pendingContract.status = Status.EXPIRED;

		ClaimsAdjudicationService adjudicator = new ClaimsAdjudicationService();
		
		adjudicator.Adjudicate(pendingContract, claim);
        
		Assert.assertEquals(0, pendingContract.getClaims().size());
	}
}
