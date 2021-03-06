import { Route } from '@angular/compiler/src/core';
import { Injectable } from '@angular/core';
import { CanActivate, Router } from '@angular/router';
import { AuthenticationService } from './authentication.service';

@Injectable({
  providedIn: 'root'
})
export class AuthGuardService implements CanActivate{

  constructor(
    private auth:AuthenticationService,
    private route: Router
  ) { }
  canActivate():boolean{
    if(!this.auth.currentUserValue){
  this.route.navigate(['/login/'],{queryParams: {auth:'true'} });
  return false;
  }
  return true;
  }
}
